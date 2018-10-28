<?php

namespace App\Http\Middleware;

use Closure;

class authRepar
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
        //  Redirección de usuarios no autorizados a ingresar al espacio de repartidor.
        
        if(auth()->check()){
            //  Usuario con sesión de cliente.
            if ( auth()->user()->tipo == 'cliente' ) {
                return redirect('/home');
            }
            //  Usuario con sesión de administrador.
            if ( auth()->user()->tipo == 'administrador' ) {
                return redirect('/administrador/home');
            }
        }
        
        //  Si el repartidor no se ha logeado lo envía al login.
        if (!auth()->guard('repartidores')->check() ) {
            return redirect('/repartidores/login');
        }
        
        return $next($request);
    }
}
