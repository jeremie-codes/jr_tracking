<?php

use Illuminate\Foundation\Application;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // // Capturer l'erreur 403 (AuthorizationException)
        // $exceptions->renderable(function (AuthorizationException $e, $request) {
        //     return response()->view('errors.403', [], 403);
        // });

        // // Capturer l'erreur 404 (NotFoundHttpException ou ModelNotFoundException)
        // $exceptions->renderable(function (NotFoundHttpException $e, $request) {
        //     return response()->json([
        //         'message' => 'Page'
        //     ]);
        // });

        // $exceptions->renderable(function (ModelNotFoundException $e, $request) {
        //     return response()->view('errors.404', [], 404);
        // });
    })
    ->create();
