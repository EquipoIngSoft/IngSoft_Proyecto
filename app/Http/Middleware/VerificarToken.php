<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarToken
{
    /**
     * Verifica que el usuario tenga una sesión activa.
     * Si no la tiene, redirige al login.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('usuario_id')) {
            return redirect()->route('login')
                ->withErrors(['session' => 'Debes iniciar sesión para acceder a esta página.']);
        }

        return $next($request);
    }
}
