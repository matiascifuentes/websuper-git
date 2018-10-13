<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Product;

class LlenadoCanastaController extends Controller
{
    //
    public function __construct()
    {
    	if(!\Session::has('prodCanasta')) \Session::put('prodCanasta' , array());
    }

    public function show ()
    {
    	$prodCanasta = \Session::get('prodCanasta');
    	$total = $this->total();
    	return view('administrador/canastas.llenadocanasta',['prodCanasta'=>$prodCanasta,'total'=>$total]);
    }

    public function add ($id)
    {
    	$producto = Product::where('id',$id)->first();
    	$prodCanasta = \Session::get('prodCanasta');
    	if(array_key_exists($id,$prodCanasta)){
    		$producto->cantidad = $prodCanasta[$id]->cantidad + 1;
    	}
    	else{
    		$producto->cantidad = 1;
    	}
    	$prodCanasta[$id] = $producto;
    	\Session::put('prodCanasta',$prodCanasta);

    	return redirect()->route('prodCanasta-show');
    }

    public function delete($id)
    {
    	$prodCanasta = \Session::get('prodCanasta');
    	unset($prodCanasta[$id]);
    	\Session::put('prodCanasta',$prodCanasta);
    	return redirect()->route('prodCanasta-show');
    }
	public function update($id,$cantidad)
    {
    	$prodCanasta = \Session::get('prodCanasta');
    	$prodCanasta[$id]->cantidad = $cantidad;
 
    	\Session::put('prodCanasta',$prodCanasta);
    	return redirect()->route('prodCanasta-show');

    }
    public function vaciar()
    {
    	\Session::forget('prodCanasta');
    	return redirect()->route('prodCanasta-show');
    }
    public function guardar()
    {
    	$prodCanasta = \Session::get('prodCanasta');
    	return view('administrador/canastas.guardar',["prodCanasta"=>$prodCanasta]);
    }

   	private function total()
   	{
   		$prodCanasta = \Session::get('prodCanasta');
   		$total = 0;
   		foreach ($prodCanasta as $item) {
   			$total += $item->precio * $item->cantidad;
   		}
   		return $total;
   	}
}
