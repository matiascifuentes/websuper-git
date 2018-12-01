<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Hash;

use App\repartidor;
use App\Historial;

class repartidorController extends Controller
{
    /**
     * Mostrar el index de CRUD repartidores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Obteniendo los datos de repartidores.
        $repartidor = repartidor::orderBy('id','ASC')->paginate();
        return view('administrador/repartidores.index',["repartidores"=>$repartidor]);
  //
    }

    /**
     * Mostrar el formulario de nuevo repartidor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador/repartidores.create');
        //
    }

    /**
     * Guardar un nuevo repartidor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Creando nuevo repartidor.
        $repartidor = new repartidor;
        //  Obteniendo datos desde el formulario.
        $repartidor->name = $request->input('name');
        $repartidor->edad = $request->input('edad');
        $repartidor->direccion = $request->input('direccion');
  
        $repartidor->fecha_ingreso = $request->input('fecha_ingreso');
        $repartidor->situacion = $request->input('situacion');
        $repartidor->disponibilidad = $request->input('disponibilidad');

        
        $repartidor->email = $request->input('email');
        $repartidor->password = Hash::make($request->input('password'));
        $repartidor->tipo = 'repartidor';

        //  Mensajes de error.
        $messages = [
            'edad.required' => 'Agrega La edad del repartidor.',
            'edad.min' => 'La edad debe ser mayor o igual a 18',
            'edad.numeric' => 'La edad debe ser un valor numérico',
            'edad.integer' => 'La edad debe ser un número entero',
            'direccion.required' => 'Agrega la direccion del repartidor.',
            'fecha_ingreso.required' => 'Agrega la fecha de ingreso.',
            'situacion.required' => 'Agrega la situacion del repartidor.',
            'disponibilidad.required' => 'Agrega la disponibilidad del repartidor.',
            'email.required' => 'Debe ingresar un e-mail',
            'email.unique' => 'El e-mail ya está en uso por otro usuario',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres',
            'password.confirmed' => 'La contraseña no coincide con la confirmación'
            
        ];
        //  Validando los datos ingresados.
        $this->validate($request,['edad'=>'required|numeric|integer|min:18', 'direccion'=>'required', 'fecha_ingreso'=>'required', 'situacion'=>'required', 'disponibilidad'=>'required','email' => 'required|string|email|max:255|unique:repartidores',
            'password' => 'required|string|min:6|confirmed',],$messages);
        //  Guardando los datos.
        $repartidor->save();
        return redirect()->route('repartidores.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Mostrar los datos de un repartidor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  Obteniendo los datos del repartidor.
        $repartidor = repartidor::where('id',$id)->first();
        return view('administrador/repartidores.show',["repartidores"=>$repartidor]);
    }

    /**
     * Mostrar el formulario para editar un repartidor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  Obteniendo los datos actuales del repartidor.
        $repartidor=repartidor::find($id);
        return view('administrador/repartidores.edit',["repartidor"=>$repartidor]);
    }

    /**
     * Actualizar un repartidor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //  Obteniendo datos actuales del repartidor.
        $repartidor = repartidor::find($id);
        //  Cambiando datos antiguos por nuevos.
        $repartidor->name = $request->input('name');
        $repartidor->edad = $request->input('edad');
        $repartidor->direccion = $request->input('direccion');
        $repartidor->fecha_ingreso = $request->input('fecha_ingreso');
        $repartidor->situacion = $request->input('situacion');
        if ($repartidor->situacion == "Inactivo") {
            $repartidor->disponibilidad = "No disponible";
        }
        //  Mensajes de error.
        $messages = [
            'edad.required' => 'Agrega La edad del repartidor.',
            'edad.min' => 'La edad debe ser mayor o igual a 18',
            'edad.numeric' => 'La edad debe ser un valor numérico',
            'edad.integer' => 'La edad debe ser un número entero',
            'direccion.required' => 'Agrega la direccion del repartidor.',
            'fecha_ingreso.required' => 'Agrega la fecha de ingreso.',
            'situacion.required' => 'Agrega la situacion del repartidor.',
            'email.required' => 'Debe ingresar un e-mail',
            'email.unique' => 'El e-mail ya está en uso por otro usuario',
            
        ];
        //  Validando los datos.
        $this->validate($request,[ 'name'=>'required', 'edad'=>'required|numeric|integer|min:18', 'direccion'=>'required', 'fecha_ingreso'=>'required', 'situacion'=>'required'],$messages);
        //  Guardando los nuevos datos.
        $repartidor->save();
        return redirect()->route('repartidores.index')->with('success','Registro actualizado satisfactoriamente');
        //
    }

    /**
     * Eliminar un repartidor de la base de datos.
     *  
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  Eliminando repartidor.
        repartidor::destroy($id);
        return redirect()->route('repartidores.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
