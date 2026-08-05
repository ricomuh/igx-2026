<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Global so it also covers Filament panel routes (which use their own
        // middleware stack, not the 'web' group).
        $middleware->append(
            \App\Http\Middleware\EnsureTicketDomainIsolation::class,
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
