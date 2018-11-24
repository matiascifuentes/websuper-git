<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\Input;

use App\Pedido;
use App\Detalle_pedido; 
use App\Entrega;
use DB;


class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
    	//setup Paypal api context
    	$paypal_conf = \Config::get('paypal');
    	$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'],$paypal_conf['secret']));
    	$this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment()
    {
    	$payer = new Payer();
    	$payer->setPaymentMethod('paypal');

    	$items = array();
    	$subtotal = 0;
    	$cart = \Session::get('cart');
    	$currency = 'USD';

    	foreach($cart as $producto){
    		$item = new Item();
    		$item->setName($producto->titulo)
    		->setCurrency($currency)
    		->setDescription($producto->descripcion)
    		->setQuantity($producto->cantidad)
    		->setPrice($producto->precio);

    		$items[] = $item;
    		$subtotal += $producto->cantidad * $producto->precio;
    	}

    	$item_list = new ItemList();
    	$item_list->setItems($items);

    	$total = $subtotal;

    	$amount = new Amount();
    	$amount->setCurrency($currency)
    		->setTotal($total);

    	$transaction = new Transaction();
    	$transaction->setAmount($amount)
    		->setItemList($item_list)
    		->setDescription('Pedido de prueba para SuperWeb');

    	$redirect_urls = new RedirectUrls();
    	$redirect_urls->setReturnUrl(\URL::route('payment.status'))
    		->setCancelUrl(\URL::route('payment.status'));

    	$payment = new Payment();
    	$payment->setIntent('Sale')
    		->setPayer($payer)
    		->setRedirectUrls($redirect_urls)
    		->setTransactions(array($transaction));
    	try {
    		$payment->create($this->_api_context);
    	} catch(\Paypal\Exception\PPConnectionException $ex){
    		if(\Config::get('app.debug')) {
    			echo "Exception: ". $ex->getMessage(). PHP_EOL;
    			$err_data = json_decode($ex->getData(),true);
    			exit;
    		}else{
    			die('Ups! ALgo salio mal...');
    		}
    	}

    	foreach($payment->getLinks() as $link){
    		if($link->getRel() == 'approval_url'){
    			$redirect_url = $link->getHref();
    			break;
    		}
    	}

    	// agregar pago ID a la session
    	\Session::put('paypal_payment_id',$payment->getId());
    	if(isset($redirect_url)){
    		//redirige a paypal
    		return \Redirect::away($redirect_url);
    	}

    	return \Redirect::route('cart-show')
    		->with('error', 'Ups! Error desonocido. ');
    }

	public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');

		// clear the session payment ID
		\Session::forget('paypal_payment_id');

		$payerId = \Input::get('PayerID');
		$token = \Input::get('token');

		//if (empty(\Input::get('PayerID')) || empty(\Input::get('token'))) {
		if (empty($payerId) || empty($token)) {
			return \Redirect::route('home')
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}

		$payment = Payment::get($payment_id, $this->_api_context);

		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(\Input::get('PayerID'));

		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);

		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

		if ($result->getState() == 'approved') { // payment made
			// Registrar el pedido --- ok
			// Registrar el Detalle del pedido  --- ok
			// Eliminar carrito 
			// Enviar correo a user
			// Enviar correo a admin
			// Redireccionar

			$this->savePedido();

			\Session::forget('cart');


			return \Redirect::route('home')
				->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::route('home')
			->with('message', 'La compra fue cancelada');
	}

    protected function savePedido()
    {
        $subtotal = 0;
        $cart = \Session::get('cart');

        foreach($cart as $producto){
            $subtotal += $producto->precio * $producto->cantidad;
        }
        // Intentamos primero saber si se ha utilizado un proxy para acceder a la página,
        // y si éste ha indicado en alguna cabecera la IP real del usuario.
        if (getenv('HTTP_CLIENT_IP')) {
          $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
          $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
          $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
          $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
          $ip = getenv('HTTP_FORWARDED');
        } else {
          // Método por defecto de obtener la IP del usuario
          // Si se utiliza un proxy, esto nos daría la IP del proxy
          // y no la IP real del usuario.
          $ip = $_SERVER['REMOTE_ADDR'];
        }


        $pedido = Pedido::create([
            'subtotal' => $subtotal,
            'user_id' => \Auth::user()->id,
            'ip' => $ip
        ]);                                 //Crea una insercion en la tabla pedido

        foreach($cart as $producto){
            $this->saveDetallePedido($producto,$pedido->id); //Llamada a funcion para insertar en  tabla detalle_pedido
        }

        $this->crearEntrega($pedido->id); //Crear una nueva entrega para un pedido
    }

    protected function saveDetallePedido($producto,$pedido_id)
    {
        Detalle_pedido::create([
            'precio' => $producto->precio,
            'cantidad'=> $producto->cantidad,
            'product_id' => $producto->id,
            'pedido_id' => $pedido_id
        ]); //Inserta en tabla detalle_pedido
    }

    protected function crearEntrega($pedido_id)
    {

        //  Seleccion del repartidor que no ha realizado ninguna entrega
        $repartidor = DB::select("SELECT r.id AS id 
                                    FROM repartidores r 
                                    FULL JOIN entrega e on r.id = e.repartidor_id 
                                    WHERE (e.repartidor_id is null) 
                                    AND (r.disponibilidad = 'Disponible')
                                    ORDER BY id
                                    LIMIT 1;");

        //  Evaluar si todos los repartidores han realizado entregas durante el dia
        if(!$repartidor){
             //Selecion de la mejor opcion entre los repartidores para realizar el pedido, este es aquel que ha hecho menos entregas en el dia y que se encuentra disponible.
            $repartidor = DB::select("SELECT e.repartidor_id AS id, COUNT(*) AS cant_vent 
                                        FROM entrega e 
                                        INNER JOIN repartidores r ON e.repartidor_id = r.id 
                                        WHERE (e.created_at > current_date)
                                        AND (r.disponibilidad = 'Disponible') 
                                        GROUP BY e.repartidor_id 
                                        ORDER BY cant_vent ASC 
                                        LIMIT 1;"); 
        }
        //  Evaluar si ningun repartidor ha realizado entregas en el dia
        if(!$repartidor){
            //Selecion de la mejor opcion entre los repartidores para realizar el pedido, este es aquel que ha hecho menos entregas EN TOTAL y que se encuentra disponible.
            $repartidor = DB::select("SELECT e.repartidor_id AS id, COUNT(*) AS cant_vent 
                                        FROM entrega e 
                                        INNER JOIN repartidores r ON e.repartidor_id = r.id 
                                        WHERE (r.disponibilidad = 'Disponible') 
                                        GROUP BY e.repartidor_id 
                                        ORDER BY cant_vent ASC 
                                        LIMIT 1;");
        }  
        //  Si aun no hay repartidor significa que no hay repartidor disponible
        if(!$repartidor){
            //  Se asigna el pedido al repartidor con mas entregas, ya que es quien esta disponible con mayor regularidad.
            $repartidor = DB::select("SELECT e.repartidor_id AS id, COUNT(*) AS cant_vent 
                                        FROM entrega e 
                                        INNER JOIN repartidores r ON e.repartidor_id = r.id 
                                        GROUP BY e.repartidor_id 
                                        ORDER BY cant_vent DESC 
                                        LIMIT 1;");
        }

        foreach($repartidor as $repa){
            $this->saveEntrega($pedido_id,$repa->id); //Llamada para insertar en la tabla entrega
        }

    }

    protected function saveEntrega($pedido_id,$repart_id)
    {
        $entrega = new Entrega;
        $entrega->pedido_id = $pedido_id;
        $entrega->repartidor_id = $repart_id;
        $entrega->estado = 'Activo';
        $entrega->save();  //sentencia que realiza la insercion en la tabla entrega.        
                             
    }
    protected function getClientIps()
    {
        $clientIps = array();
        $ip = $this->server->get('REMOTE_ADDR');
        if (!$this->isFromTrustedProxy()) {
            return array($ip);
        }
        if (self::$trustedHeaders[self::HEADER_FORWARDED] && $this->headers->has(self::$trustedHeaders[self::HEADER_FORWARDED])) {
            $forwardedHeader = $this->headers->get(self::$trustedHeaders[self::HEADER_FORWARDED]);
            preg_match_all('{(for)=("?\[?)([a-z0-9\.:_\-/]*)}', $forwardedHeader, $matches);
            $clientIps = $matches[3];
        } elseif (self::$trustedHeaders[self::HEADER_CLIENT_IP] && $this->headers->has(self::$trustedHeaders[self::HEADER_CLIENT_IP])) {
            $clientIps = array_map('trim', explode(',', $this->headers->get(self::$trustedHeaders[self::HEADER_CLIENT_IP])));
        }
        $clientIps[] = $ip; // Complete the IP chain with the IP the request actually came from
        $ip = $clientIps[0]; // Fallback to this when the client IP falls into the range of trusted proxies
        foreach ($clientIps as $key => $clientIp) {
            // Remove port (unfortunately, it does happen)
            if (preg_match('{((?:\d+\.){3}\d+)\:\d+}', $clientIp, $match)) {
                $clientIps[$key] = $clientIp = $match[1];
            }
            if (IpUtils::checkIp($clientIp, self::$trustedProxies)) {
                unset($clientIps[$key]);
            }
        }
        // Now the IP chain contains only untrusted proxies and the client IP
        return $clientIps ? array_reverse($clientIps) : array($ip);
    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
}
