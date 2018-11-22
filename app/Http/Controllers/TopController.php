<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Detalle_pedido;
use App\Pedido;

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
    public function showCompras()
    {
        $id = auth()->user()->id;
        $pedidos = Pedido::where('user_id',$id)
                            ->orderBy('created_at','DESC')
                            ->get();
        return view('home.hcompras',["userid"=>$id,"pedidos"=>$pedidos]);
    }
}
