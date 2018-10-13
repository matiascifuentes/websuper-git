<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class CartController extends Controller
{
    public function __construct()
    {
    	if(!\Session::has('cart')) \Session::put('cart',array());
    }
	
	//Mostrar carro

	public function show()
	{
		$cart = \Session::get('cart');
		$total = $this->total();
		return view('home.cart',compact('cart', 'total'));
	}

	//Agregar producto

	public function add(Product $product)
	{	
		$cart = \Session::get('cart');
    	if (array_key_exists($product->id, $cart)){
    		$ops = $cart[$product->id]->cantidad;
    		$product->cantidad = $ops+1;
    	}
    	else{
    	    $product->cantidad = 1;	
    	}
    	$cart[$product->id] = $product;
		\Session::put('cart',$cart);

		return redirect()->route('cart-show');

	}

	//Eliminar item

	public function delete(Product $product)
	{
		$cart = \Session::get('cart');
		unset($cart[$product->id]);
		\Session::put('cart', $cart);

		return redirect()->route('cart-show');
	}

	//Actualizar Item
	public function update(Product $product, $cantidad)
	{
		$cart = \Session::get('cart');
		$cart[$product->id]->cantidad = $cantidad;
		\Session::put('cart', $cart);

		return redirect()->route('cart-show');

	}

	//Eliminar carro

	public function trash()
	{
		\Session::forget('cart');

		return redirect()->route('cart-show');
	}

	//Total

	private function total()
	{
		$cart = \Session::get('cart');
		$total = 0;
		foreach($cart as $item){
			$total += $item->precio * $item->cantidad;
		}
		return $total;
	}

	//Detalle del pedido

	public function orderDetail()
	{
		if(count(\Session::get('cart')) <= 0) return redirect()->route('home');
		$cart = \Session::get('cart');
		$total = $this->total();

		return view('home.order-detail',compact('cart','total'));
	}
}
