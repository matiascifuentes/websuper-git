<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Product;

class LlenadoCanastaController extends Controller
{
    public function __construct()
    {
        //  Creando la sesión.
    	if(!\Session::has('prodCanasta')) \Session::put('prodCanasta' , array());
    }

    public function show ()
    {
        //  Obteniendo los productos de la sesión y el total.
    	$prodCanasta = \Session::get('prodCanasta');
    	$total = $this->total();
        //  Enviando los datos para ser mostrados.
    	return view('administrador/canastas.llenadocanasta',['prodCanasta'=>$prodCanasta,'total'=>$total]);
    }

    public function add ($id)
    {
        //  Obteniendo los datos del producto.
    	$producto = Product::where('id',$id)->first();
        //  Obteniendo los productos almacenados en la sesión.
    	$prodCanasta = \Session::get('prodCanasta');
    	if(array_key_exists($id,$prodCanasta)){
            //  Si el producto ya existe se le suma 1 a la cantidad.
    		$producto->cantidad = $prodCanasta[$id]->cantidad + 1;
    	}
    	else{
            //  Si el producto no existe la cantidad es 1.
    		$producto->cantidad = 1;
    	}
        //  Agregando el producto a la sesión.
    	$prodCanasta[$id] = $producto;
    	\Session::put('prodCanasta',$prodCanasta);

        //  Enviando los datos a la vista.
    	return redirect()->route('prodCanasta-show');
    }

    public function delete($id)
    {
        //  Obteniendo los productos almacenados en la sesión.
    	$prodCanasta = \Session::get('prodCanasta');
        //  Eliminando el producto de la sesión.
    	unset($prodCanasta[$id]);
    	\Session::put('prodCanasta',$prodCanasta);
        //  Enviando los datos a la vista.
    	return redirect()->route('prodCanasta-show');
    }
	public function update($id,$cantidad)
    {
        //  Obteniendo los productos almacenados en la sesión.
    	$prodCanasta = \Session::get('prodCanasta');
        //  Actualizando la cantidad del producto.
    	$prodCanasta[$id]->cantidad = $cantidad;
        //  Actualizando la sesión.
    	\Session::put('prodCanasta',$prodCanasta);
        //  Enviando los datos a la vista.
    	return redirect()->route('prodCanasta-show');

    }
    public function vaciar()
    {
        //  Eliminando todos los datos de la sesión.
    	\Session::forget('prodCanasta');
    	return redirect()->route('prodCanasta-show');
    }
    public function guardar()
    {
    	$prodCanasta = \Session::get('prodCanasta');
        //  Enviando los datos de la sesión a la vista guardar.
    	return view('administrador/canastas.guardar',["prodCanasta"=>$prodCanasta]);
    }

   	private function total()
   	{
        //  Obteniendo el precio total de los productos de la sesión.
   		$prodCanasta = \Session::get('prodCanasta');
   		$total = 0;
   		foreach ($prodCanasta as $item) {
   			$total += $item->precio * $item->cantidad;
   		}
   		return $total;
   	}
}
