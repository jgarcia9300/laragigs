<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

//la siguiente clase se encarga de redirigir al usuario a la pagina de inicio de sesion si no esta autenticado
class Authenticate extends Middleware 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request //parametro que recibe la peticion del usuario
     * @return string|null  //retorna un string o un valor nulo
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) { //si la peticion no es de tipo json
            return route('login');  //retorna la ruta de inicio de sesion
        }
    }
}