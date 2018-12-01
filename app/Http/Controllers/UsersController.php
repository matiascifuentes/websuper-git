<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Mostrar el formulario para editar datos de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('users.index');
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
     * Guardar los datos del usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Validando los datos ingresados al formulario.
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required',
            'city' => 'required|string|min:2|max:25',
            'address' => 'required|string|min:4',
            'phone' => 'required|string|min:8|max:12',
        ]);
        //  Asignando los datos a una variable.
        $data = $request->all();
        //  Actualizando los datos del usuario logeado.
        $update=auth()->user()->update($data);

        if($update)
            return redirect()->route('profile')->with('success', 'Éxito al actualizar');

        return redirect()->back()->with('error','Fallo al actualizar');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
}
