<?php

namespace App\Http\Middleware;

use Closure;

class authCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //  Redirección de usuarios no autorizados a ingresar al espacio de cliente.

        
        if (auth()->guard('repartidores')->check() ) {
            //  Usuario con sesión de repartidor.
            return redirect('/repartidor');
        }

        if(auth()->check()){
            //  Usuario con sesión de administrador.
            if ( auth()->user()->tipo == 'administrador' ) {
                return redirect('/administrador/home');
            }
        }
        else{
            // Usuario sin sesión.
            return redirect('/login');
        }

        return $next($request);
    }
}
