<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        return $redirectTo;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'region' => 'required',
            'city' => 'required|string|min:2|max:25',
            'address' => 'required|string|min:4',
            'phone' => 'required|string|min:8|max:12',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $resultado = User::all();
        if ($resultado->count()) {
            // Si existen cuentas el tipo será cliente
            $tipo = 'cliente';
        }
        else{
            // La primera cuenta será administrador
            $tipo = 'administrador';
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo' => $tipo,
            'region'=> $data['region'],
            'city'=> $data['city'],
            'address'=> $data['address'],
            'phone'=> $data['phone'],
        ]);
    }
}
