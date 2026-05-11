<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectAutentificado
{
    public function handle(Request $request, Closure $next)
    {
        // Si ya está logueado como cliente
        if (session()->has('cliente_id')) {
            return redirect()->route('iniciusuario');
        }

        // Si ya está logueado como doctor
        if (session()->has('doctor_id')) {
            return redirect()->route('doctor.agenda');
        }

        // Si ya está logueado como admin
        if (session()->has('admin_id')) {
            return redirect()->route('iniciadministrativo');
        }

        // Si no está logueado → continuar
        return $next($request);
    }
}
