<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Product;

class LlenadoCanastaController extends Controller
{
    /**
     * Constructor que crea la sesion prodCanasta.
     *
     */
    public function __construct()
    {
        //  Creando la sesión prodCanasta.
    	if(!\Session::has('prodCanasta')) \Session::put('prodCanasta' , array());
    }

    /**
     * Mostrar el carro de canasta.
     *
     * @return \Illuminate\Http\Response
     */
    public function show ()
    {
        //  Obteniendo los productos de la sesión.
    	$prodCanasta = \Session::get('prodCanasta');
        //  Calcular el total.
    	$total = $this->total();
        //  Enviando los datos para ser mostrados.
    	return view('administrador/canastas.llenadocanasta',['prodCanasta'=>$prodCanasta,'total'=>$total]);
    }

    /**
     * Agrega un producto al carro de canasta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Eliminar un producto del carro de canasta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Actualizar la cantidad de un producto en el carro de canasta.
     *
     * @param  int  $id
     * @param  int  $cantidad
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Eliminar todos los productos del carro de canasta.
     *
     * @return \Illuminate\Http\Response
     */
    public function vaciar()
    {
        //  Eliminando todos los datos de la sesión.
    	\Session::forget('prodCanasta');
    	return redirect()->route('prodCanasta-show');
    }

    /**
     * Mostrar el formulario de guardar canasta.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar()
    {
        //  Obteniendo los datos del carro canasta.
    	$prodCanasta = \Session::get('prodCanasta');
        //  Enviando los datos de la sesión a la vista guardar.
    	return view('administrador/canastas.guardar',["prodCanasta"=>$prodCanasta]);
    }

    /**
     * Obtener el precio total de los productos en el carro.
     *
     * @return int $total
     */
   	private function total()
   	{
        //  Obteniendo el precio total de los productos de la sesión.
   		$prodCanasta = \Session::get('prodCanasta');
   		$total = 0;
        //  Sumando el precio de cada producto.
   		foreach ($prodCanasta as $item) {
   			$total += $item->precio * $item->cantidad;
   		}
   		return $total;
   	}
}
