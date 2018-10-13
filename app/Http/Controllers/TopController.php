<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Detalle_pedido;

use DB;

class TopController extends Controller
{
    public function showTop()
    {
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
}
