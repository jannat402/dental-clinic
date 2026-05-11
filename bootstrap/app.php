<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'doctor'  => \App\Http\Middleware\CheckDoctor::class,
            'cliente' => \App\Http\Middleware\CheckCliente::class,
            'admin'   => \App\Http\Middleware\CheckAdmin::class,
            'guest.custom' => \App\Http\Middleware\RedirectAutentificado::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
