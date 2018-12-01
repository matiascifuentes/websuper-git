<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Detalle_pedido;
use App\Pedido;

use DB;

class TopController extends Controller
{
    /**
     * Mostrar el top de productos mas vendidos.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTop()
    {
        //  Obteniendo los productos mas vendidos.
    	$tops = DB::select('SELECT productos.titulo,
    							productos.precio,
    							productos.supermercado,
    							productos.categoria, 
    							detalle_pedidos.product_id, 
    							SUM(detalle_pedidos.cantidad) AS totalventas
								FROM detalle_pedidos JOIN productos 
								ON detalle_pedidos.product_id = productos.id
								GROUP BY productos.titulo,
										productos.precio,
										productos.supermercado,
										productos.categoria, 
										detalle_pedidos.product_id
								ORDER BY totalventas DESC;');
    	return view('home.top', compact('tops'));
    }

    /**
     * Mostrar el historial de compras del cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCompras()
    {
        //  Obteniendo el id asociado al usuario logeado.
        $id = auth()->user()->id;
        //  Obteniendo datos de compras realizadas por el cliente.
        $pedidos = Pedido::where('user_id',$id)
                            ->orderBy('created_at','DESC')
                            ->get();
        return view('home.hcompras',["userid"=>$id,"pedidos"=>$pedidos]);
    }
}
