<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminUserController extends Controller
{
    /**
     * Muestra el index de CRUD de usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios=User::orderBy('id','DESC')->paginate();
        return view('administrador/adminuser.index',["usuarios"=>$usuarios]);
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
     * Muestra los datos de un usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        //  Obteniendo los datos del cliente.
        $usuario = User::where('id',$id)->first();
        return view('administrador/adminuser.show',["usuario"=>$usuario]);
    }

    /**
     * Muestra el formulario para editar a un usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  Obteniendo los datos del usuario.
        $usuarios=User::find($id);
        return view('administrador/adminuser.edit',["usuarios"=>$usuarios]);
    }

    /**
     * Actualizar los datos de un usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //   Obteniendo los datos actuales del usuario.
        $usuarios = User::find($id);
        //   Cambiando los datos antiguos por los nuevos.
        $usuarios->tipo = $request->input('tipo');
        //   Guardando los cambios.
        $usuarios->save();
        return redirect()->route('usuarios.index')->with('success','Registro actualizado satisfactoriamente');
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
}
