<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Display the specified resource.
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

    public function edit($id)
    {
        //
        $usuarios=User::find($id);
        return view('administrador/adminuser.edit',["usuarios"=>$usuarios]);
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
        $usuarios = User::find($id);
        $usuarios->tipo = $request->input('tipo');


        // $messages = [
        //     'nombre.required' => 'Agrega el nombre del producto.',
        //     'precio.required' => 'Agrega el precio del producto.',
        //     'precio.min' => 'El precio debe ser mayor o igual a 1',
        //     'precio.numeric' => 'El precio debe ser un valor numérico',
        //     'precio.integer' => 'El precio debe ser un número entero',
        //     'categoria.required' => 'Agrega la categoría del producto.',
        //     'descripcion.required' => 'Agrega una descripción del producto.',
        //     'supermercado.required' => 'Agrega el supermercado al cual pertenece el producto.',
        //     'img.required' => 'Agrega una imagen al producto.',
        //     'url.required' => 'Agrega una url al producto.',
            
        // ];
        

        // $this->validate($request,[ 'nombre'=>'required', 'precio'=>'required|numeric|integer|min:1', 'categoria'=>'required', 'descripcion'=>'required', 'supermercado'=>'required', 'img'=>'required', 'url'=>'required'],$messages);


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
