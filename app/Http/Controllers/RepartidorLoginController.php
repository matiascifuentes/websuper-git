<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RepartidorLoginController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * Crear sesion login para repartidores.
     *
     */
    protected function guard()
    {
    	// Asignando un guardia a la sesión del repartidor.
    	return Auth::guard('repartidores');
    }

    /**
     * Mostrar el formulario de login repartidor.
     *
     * @return \Illuminate\Http\Response
     */
    function showLoginForm()
    {
    	//	Mostrar el login de repartidor.
    	return view('repartidores/login');
    }

    /**
     * Redireccionar segun la situacion del repartidor.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticated()
    {
    	//	Luego de autenticar al usuario se le redirige a su vista.
        if(Auth::guard('repartidores')->user()->situacion == 'Inactivo'){
            //  Si el repartidor está bloqueado por el administrador no se le permite acceder.
            Auth::guard('repartidores')->logout();
            return redirect('/repartidores/loginBloqueado');
        }
        else
        {
            return redirect('/repartidor');
        }
    }

    /**
     * Cerrar sesion repartidor.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout () {
        //	Cerrando sesión.
        Auth::guard('repartidores')->logout();
        //	Redirección luego de cerrar la sesión.
        return redirect('/repartidores/login');
    }


}
