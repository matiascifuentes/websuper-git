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
    	$currency = 'MXN';

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

        $pedido = Pedido::create([
            'subtotal' => $subtotal,
            'user_id' => \Auth::user()->id
        ]);

        foreach($cart as $producto){
            $this->saveDetallePedido($producto,$pedido->id);
        }

        $this->crearEntrega($pedido->id);
    }

    protected function saveDetallePedido($producto,$pedido_id)
    {
        Detalle_pedido::create([
            'precio' => $producto->precio,
            'cantidad'=> $producto->cantidad,
            'product_id' => $producto->id,
            'pedido_id' => $pedido_id
        ]);
    }

    protected function crearEntrega($pedido_id)
    {
        $repartidor = DB::select('SELECT repartidor_id AS id, count(*) AS cant_vent
                                  FROM entrega
                                  WHERE created_at > CURRENT_DATE  
                                  GROUP BY repartidor_id 
                                  ORDER BY cant_vent ASC LIMIT 1;');
        
        foreach($repartidor as $repa){
            $this->saveEntrega($pedido_id,$repa->id);
        }

    }

    protected function saveEntrega($pedido_id,$repart_id)
    {
        $entrega = new Entrega;
        $entrega->pedido_id = $pedido_id;
        $entrega->repartidor_id = $repart_id;
        $entrega->estado = 'Activo';
        $entrega->save();    
                             
    }
}
