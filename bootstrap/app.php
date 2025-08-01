<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(
    basePath: dirname(__DIR__)
)->withRouting(
    web: __DIR__.'/../routes/web.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)->withMiddleware(function (Middleware $middleware) {
    // Middleware global (jika perlu)
    $middleware->alias([
        'redirect.if.authenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);
})->withExceptions(function (Exceptions $exceptions) {
    // Custom handler jika ada
})->create();
