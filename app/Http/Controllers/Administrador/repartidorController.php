<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\repartidor;
use App\Historial;

class repartidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $repartidor = repartidor::orderBy('id','ASC')->paginate();
        return view('administrador/repartidores.index',["repartidores"=>$repartidor]);
  //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador/repartidores.create');
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
        $repartidor = new repartidor;
        $repartidor->nombre = $request->input('nombre');
        $repartidor->edad = $request->input('edad');
        $repartidor->direccion = $request->input('direccion');
        $repartidor->correo = $request->input('correo');
        $repartidor->fecha_ingreso = $request->input('fecha_ingreso');
        $repartidor->situacion = $request->input('situacion');
        $repartidor->disponibilidad = $request->input('disponibilidad');

        $messages = [
            'nombre.required' => 'Agrega el nombre del repartidor.',
            'edad.required' => 'Agrega La edad del repartidor.',
            'edad.min' => 'La edad debe ser mayor o igual a 18',
            'edad.numeric' => 'La edad debe ser un valor numérico',
            'edad.integer' => 'La edad debe ser un número entero',
            'direccion.required' => 'Agrega la direccion del repartidor.',
            'correo.required' => 'Agrega El correo del repartidor.',
            'fecha_ingreso.required' => 'Agrega la fecha de ingreso.',
            'situacion.required' => 'Agrega la situacion del repartidor.',
            'disponibilidad.required' => 'Agrega la disponibilidad del repartidor.',
            
        ];
        $this->validate($request,[ 'nombre'=>'required', 'edad'=>'required|numeric|integer|min:18', 'direccion'=>'required', 'correo'=>'required', 'fecha_ingreso'=>'required', 'situacion'=>'required', 'disponibilidad'=>'required'],$messages);
        
        $repartidor->save();
        return redirect()->route('repartidores.index')->with('success','Registro creado satisfactoriamente');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $repartidor = repartidor::where('id',$id)->first();
         return view('administrador/repartidores.show',["repartidores"=>$repartidor]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repartidor=repartidor::find($id);
        return view('administrador/repartidores.edit',["repartidor"=>$repartidor]);
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
        $repartidor = repartidor::find($id);
        $repartidor->nombre = $request->input('nombre');
        $repartidor->edad = $request->input('edad');
        $repartidor->direccion = $request->input('direccion');
        $repartidor->correo = $request->input('correo');
        $repartidor->fecha_ingreso = $request->input('fecha_ingreso');
        $repartidor->situacion = $request->input('situacion');
        $repartidor->disponibilidad = $request->input('disponibilidad');

        $messages = [
            'nombre.required' => 'Agrega el nombre del repartidor.',
            'edad.required' => 'Agrega La edad del repartidor.',
            'edad.min' => 'La edad debe ser mayor o igual a 18',
            'edad.numeric' => 'La edad debe ser un valor numérico',
            'edad.integer' => 'La edad debe ser un número entero',
            'direccion.required' => 'Agrega la direccion del repartidor.',
            'correo.required' => 'Agrega El correo del repartidor.',
            'fecha_ingreso.required' => 'Agrega la fecha de ingreso.',
            'situacion.required' => 'Agrega la situacion del repartidor.',
            'disponibilidad.required' => 'Agrega la disponibilidad del repartidor.',
            
        ];
        $this->validate($request,[ 'nombre'=>'required', 'edad'=>'required|numeric|integer|min:18', 'direccion'=>'required', 'correo'=>'required', 'fecha_ingreso'=>'required', 'situacion'=>'required', 'disponibilidad'=>'required'],$messages);
        
        $repartidor->save();
        return redirect()->route('repartidores.index')->with('success','Registro actualizado satisfactoriamente');
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
        repartidor::destroy($id);

        return redirect()->route('repartidores.index')->with('success','Registro eliminado satisfactoriamente');
        //
    }
}
