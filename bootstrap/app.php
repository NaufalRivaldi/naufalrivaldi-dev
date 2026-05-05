<?php

use App\VercelApplication;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$baseApp = getenv('VERCEL') ? VercelApplication::class : Application::class;

$app = $baseApp::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (getenv('VERCEL')) {
    $app->useStoragePath('/tmp/storage');
}

return $app;
