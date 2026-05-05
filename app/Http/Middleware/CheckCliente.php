<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCliente
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('cliente_id')) {
            return redirect()->route('paginainici');
        }

        return $next($request);
    }
}
