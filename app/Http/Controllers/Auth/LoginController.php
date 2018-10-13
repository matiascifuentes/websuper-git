<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function redirectTo()
    {
        if (auth()->user()->tipo == 'administrador') {
            $redirectTo = '/administrador/home';
            
        }
        if (auth()->user()->tipo == 'cliente') {
            $redirectTo = '/home';
        }
        if (auth()->user()->tipo == 'Desactivado') {
            auth()->logout();
            $redirectTo = '/loginBloqueado';
        }
        return $redirectTo;
    }
    
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //  Función para redireccionar al cerrar sesión
    public function logout () {
        //logout user
        auth()->logout();

        //Cancelar el carro de compra si la sesión es de cliente
        \Session::forget('cart'); 
        \Session::forget('total');

        //Cancelar el carro de canasta si la sesión es de administrador
        \Session::forget('prodCanasta');
        // redirigir a login
        return redirect('/login');
    }
}
