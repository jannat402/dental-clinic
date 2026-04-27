<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDoctor
{
    public function handle(Request $request, Closure $next)
    {
        // Si NO hay sesión de doctor → redirigir al login
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        return $next($request);
    }
}
