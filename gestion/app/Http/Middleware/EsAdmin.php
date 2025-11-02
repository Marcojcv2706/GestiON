<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario está logueado Y si su rol es 'Administrador'
        if (auth()->check() && auth()->user()->rol->name === 'Administrador') {
            // Si es admin, permite que la petición continúe
            return $next($request);
        }

        // Si no es admin, aborta la petición con un error 403 (Acceso Prohibido)
        abort(403, 'Acceso no autorizado.');
    }
}