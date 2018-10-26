<?php

namespace App\Http\Controllers\Repartidor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use App\repartidor;
use App\Entrega;
use App\Historial;
use App\Detalle_pedido;
use App\Pedido;

class HomeRepartidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Vista de inicio repartidor.
        return view('repartidor.index');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //  Función para mostrar tabla con entregas en curso.

        //  Obteniendo las entregas asignadas al repartidor.
        $id = Auth::guard('repartidores')->user()->id;
        $entregas = Entrega::where('repartidor_id',$id)->get();

        //  Enviando los datos a la tabla.
        return view('/repartidor/entregasEnCurso',["entregas"=>$entregas]);

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
        //  Función para actualizar la disponibilidad del repartidor.

        //  Obteniendo la disponibilidad actual.
        $repartidor = repartidor::find($id);
        //  Reemplazando con la nueva disponibilidad.
        $repartidor->disponibilidad = $request->input('disponibilidad');
        //  Guardar los cambios.
        $repartidor->save();
        return redirect()->route('repartidor.index');
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

    public function showPedido($pedido_id)
    {
        //
        $detalle_pedido = Detalle_pedido::where('pedido_id',$pedido_id)
                            ->join('productos','detalle_pedidos.product_id','=','productos.id')
                            ->get();

        $total = Pedido::where('id',$pedido_id)->select('subtotal')->first();
        $total = $total->subtotal;

        return view('repartidor.detalleEntrega',["detalle_pedido"=>$detalle_pedido , "total"=>$total]);
    }
}
