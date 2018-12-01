<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Canasta;
use App\DetalleCanasta;

class CanastasClienteController extends Controller
{
    /**
     * Constructor que crea una sesion para el carro.
     *
     */
    public function __construct()
    {
        //  Creando la sesion para el carro de compras.
    	if(!\Session::has('cart')) \Session::put('cart',array());
    }

    /**
     * Mostrar el index de canastas al cliente.
     *
     */
    public function indexCanastas(){
    	//  Obteniendo los datos de canastas.
        $canastas = Canasta::orderBy('id','ASC')->paginate();
        //  Enviando los datos a la vista.
        return view('home.canastasCliente',["canastas"=>$canastas]);
    }

    /**
     * Mostrar el detalle de una canasta.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showCanasta($id){
    	//  Obteniendo los datos asociados al id.
        $prodCanasta = DetalleCanasta::where('cod_c',$id)
                        ->join('productos','detalle_canasta.cod_p','=','productos.id')
                        ->get();
        //  Obteniendo el total de la canasta.
        $total = $this->total($prodCanasta);
        //  Enviando los datos a la vista.
        return view('home.showCanasta',["prodCanasta"=>$prodCanasta,"total"=>$total,"canastaID"=>$id]);
    }

    /**
     * Agregar un producto al carro de compra.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function add($id){
    	//	Obteniendo los productos de la canasta id.
		$prodCanasta = DetalleCanasta::where('cod_c',$id)
		            ->join('productos','detalle_canasta.cod_p','=','productos.id')
		            ->get();
		//	Agregando los productos al carro.
		foreach ($prodCanasta as $prod) {
			//	Obteniendo los datos del carro.
			$cart = \Session::get('cart');
	    	if (array_key_exists($prod->id, $cart)){
	    		//	Si el producto ya está en el carro se aumenta la cantidad.
	    		$ops = $cart[$prod->id]->cantidad;
	    		$prod->cantidad = $prod->cantidad + $ops;
	    	}
	    	$cart[$prod->id] = $prod;
	    	//	Enviando los datos al carro.
			\Session::put('cart',$cart);	
		}
		//	Mostrar el carro.
		return redirect()->route('cart-show');

    }

    /**
     * Calcular el precio total de los productos en el carro.
     *
     * @param  array $array
     * @return int $total
     */
    private function total($array)
    {   
        $total = 0;
        foreach ($array as $item) {
            //  Se agrega al total el subtotal de cada item.
            $total += $item->precio * $item->cantidad;
        }
        //  Retornando el total.
        return $total;
    }
}
