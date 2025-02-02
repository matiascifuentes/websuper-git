<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Hash;

use App\Entrega;
use App\Historial;
use App\Detalle_pedido;

use DB;

class EntregaController extends Controller
{
    /**
     * Muestra el index de entregas activas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Obteniendo todas las entregas activas.
        $entrega = entrega::where('estado','Activo')
                        ->join('pedidos','entrega.pedido_id','=','pedidos.id')
                        ->get();
        $ip='181.42.29.24';
        //$arr_ip = geoip()->getLocation('192.168.8.105');
        $data = \Location::get($ip);
        //return dd($data);
        return view('administrador/entregas.index',["entregas"=>$entrega, "datas"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra el detalle de una entrega.
     *
     * @param  int  $pedido_id
     * @return \Illuminate\Http\Response
     */
    public function show($pedido_id)
    {
        //  Obteniendo el detalle del pedido.
        $detalle_pedidos = Detalle_pedido::where('pedido_id',$pedido_id)
                            ->join('productos','detalle_pedidos.product_id','=','productos.id')
                            ->get();
        return view('administrador/entregas.show',["detalle_pedido"=>$detalle_pedidos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Muestra el index de entregas realizadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function hpedidos(){

        //  Obteniendo las entregas realizadas.
        $pedidos = DB::select("SELECT entrega.pedido_id, 
                                repartidores.name, 
                                entrega.created_at, 
                                entrega.updated_at 
                                FROM entrega 
                                INNER JOIN repartidores 
                                ON entrega.repartidor_id = repartidores.id 
                                WHERE entrega.estado  = 'Entregado';");

        return view('administrador.pedidos.hpedidos',["pedidos"=>$pedidos]);
    }

    /**
     * Mostrar el detalle de una entrega realizada.
     *
     * @param  int  $pedido_id
     * @return \Illuminate\Http\Response
     */
    public function showDetallePedido($pedido_id){
        //  Obteniendo el detalle de una entrega.
        $detalle_pedidos = Detalle_pedido::where('pedido_id',$pedido_id)
                            ->join('productos','detalle_pedidos.product_id','=','productos.id')
                            ->get();
        return view('administrador/pedidos.show',["detalle_pedido"=>$detalle_pedidos]);
    }
}
