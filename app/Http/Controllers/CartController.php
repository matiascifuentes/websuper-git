<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class CartController extends Controller
{
    /**
     * Constructor que crea una sesion para el carro.
     *
     */
    public function __construct()
    {
    	if(!\Session::has('cart')) \Session::put('cart',array());
    }
	
    /**
     * Mostrar el carro de compras.
     *
     * @return \Illuminate\Http\Response
     */
	public function show()
	{
		//	Obteniendo los productos del carro.
		$cart = \Session::get('cart');
		//	Calculando el total.
		$total = $this->total();
		return view('home.cart',compact('cart', 'total'));
	}

    /**
     * Agrega un producto al carro de compras.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
	public function add(Product $product)
	{	
		//	Obteniendo los productos del carro.
		$cart = \Session::get('cart');
		//	Si el producto ya esta en el carro se le suma 1 a la cantidad.
    	if (array_key_exists($product->id, $cart)){
    		$ops = $cart[$product->id]->cantidad;
    		$product->cantidad = $ops+1;
    	}
    	//	Si el producto no estaba su cantidad es 1.
    	else{
    	    $product->cantidad = 1;	
    	}
    	$cart[$product->id] = $product;
    	//	Agregando el producto.
		\Session::put('cart',$cart);

		return redirect()->route('cart-show');

	}

    /**
     * Eliminar un producto del carro de compras.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
	public function delete(Product $product)
	{
		//	Obteniendo los productos del carro.
		$cart = \Session::get('cart');
		//	Eliminando el producto del carro.
		unset($cart[$product->id]);
		\Session::put('cart', $cart);

		return redirect()->route('cart-show');
	}

    /**
     * Actualizar la cantidad de un producto del carro de compras.
     *
     * @param  \App\Product  $product
     * @param  int $cantidad
     * @return \Illuminate\Http\Response
     */
	public function update(Product $product, $cantidad)
	{
		//	Obteniendo los productos del carro.
		$cart = \Session::get('cart');
		//	Actualizando la cantidad.
		$cart[$product->id]->cantidad = $cantidad;
		\Session::put('cart', $cart);

		return redirect()->route('cart-show');
	}

    /**
     * Eliminar todos los productos del carro de compras.
     *
     * @return \Illuminate\Http\Response
     */
	public function trash()
	{
		//	Limpiando el carro de compras.
		\Session::forget('cart');
		return redirect()->route('cart-show');
	}

    /**
     * Obtener el precio total de los productos en el carro.
     *
     * @return int $total
     */
	private function total()
	{
		//	Obteniendo los productos del carro.
		$cart = \Session::get('cart');
		$total = 0;
		//	Sumando el precio de cada producto.
		foreach($cart as $item){
			$total += $item->precio * $item->cantidad;
		}
		return $total;
	}

    /**
     * Mostrar el detalle de la compra que se va a realizar.
     *
     * @return \Illuminate\Http\Response
     */
	public function orderDetail()
	{
		//	Si el carro esta vacio lleva al home.
		if(count(\Session::get('cart')) <= 0) return redirect()->route('home');
		//	Obteniendo datos del carro.
		$cart = \Session::get('cart');
		//	Calculando total.
		$total = $this->total();

		return view('home.order-detail',compact('cart','total'));
	}
}
