<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function(AccessDeniedHttpException $e) {
            return response()->json([
                'error_message' => 'No tiene autorización para realizar esta acción.'
            ], Response::HTTP_FORBIDDEN);
        });

        $exceptions->render(function(MethodNotAllowedHttpException $e) {
            return response()->json([
                'error_message' => 'Método incorrecto.'
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function(NotFoundHttpException $e) {
            return response()->json([
                'error_message' => 'Ruta inválida.'
            ], Response::HTTP_NOT_FOUND);
        });
    })->create();
