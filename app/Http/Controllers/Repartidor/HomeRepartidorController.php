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
     * Mostrar el index del repartidor.
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
     * Mostrar las entregas en curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //  Obteniendo las entregas asignadas al repartidor.
        $id = Auth::guard('repartidores')->user()->id;
        $entregas = Entrega::where('repartidor_id',$id)
                            ->where('estado','Activo')
                            ->get();

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
     * Actualizar la disponibilidad del repartidor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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

    /**
     * Mostrar el detalle de un pedido.
     *
     * @param  int  $pedido_id
     * @return \Illuminate\Http\Response
     */
    public function showPedido($pedido_id)
    {
        //  Obteniendo el detalle del pedido.
        $detalle_pedido = Detalle_pedido::where('pedido_id',$pedido_id)
                            ->join('productos','detalle_pedidos.product_id','=','productos.id')
                            ->get();

        //  Obteniendo el precio total del pedido.
        $total = Pedido::where('id',$pedido_id)->select('subtotal')->first();
        $total = $total->subtotal;

        //  Enviando los datos a la vista que muestra los productos que se deben entregar.
        return view('repartidor.detalleEntrega',["detalle_pedido"=>$detalle_pedido , "total"=>$total]);
    }

    /**
     * Actualizar el estado de una entrega.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEntrega($pedido_id)
    {
        //  Obteniendo los datos actuales.
        $entrega = Entrega::find($pedido_id);
        //  Reemplazando con el nuevo estado.
        $entrega->estado = "Entregado";
        //  Guardar los cambios.
        $entrega->save();
        return redirect()->route('repartidor.index');
    }

    /**
     * Mostrar el historial de entregas realizadas por un repartidor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hentregas()
    {
        //  Obteniendo el id del repartidor logeado.
        $id = Auth::guard('repartidores')->user()->id;
        //  Obteniendo las entregas realizadas por el repartidor.
        $entregas = Entrega::where('repartidor_id',$id)
                            ->where('estado','Entregado')
                            ->orderBy('updated_at','DESC')
                            ->get();
        return view('repartidor.histentregados',['entregas'=>$entregas]);
    }
}
