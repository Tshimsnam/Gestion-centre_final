<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Foundation\Application;
use App\Http\Middleware\PermissionUser;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'permissions' => PermissionUser::class,
            'checkRole' => CheckUserRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $exception, Request $request) {

            if ($exception instanceof NotFoundHttpException) {
                return response()->view("errors.404", [], 404);
            }

            if ($exception instanceof HttpException && $exception->getStatusCode() == 400) {
                return response()->view("admin.errors.400", [], 400);
            }

            if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
                return response()->view("admin.errors.403", [], 403);
            }

            if ($exception instanceof HttpException && $exception->getStatusCode() == 500) {
                return response()->view("errors.500", [], 500);
            }

            if ($exception instanceof QueryException) {
                return response()->view(
                    'errors.500',
                    ['message' => "Il y a un problème de connexion à la base de données."],
                    500
                );
            }

            if ($exception instanceof HttpException && $exception->getStatusCode() == 503) {
                return response()->view("errors.503", [], 503);
            }
        });
    })->create();