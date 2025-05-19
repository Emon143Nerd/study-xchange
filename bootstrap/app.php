<?php

use App\Http\Middleware\CompanyUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\UniversityUser;
use App\Http\Middleware\NormalUser;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'super-admin' => SuperAdmin::class,
            'university-user' => UniversityUser::class,
            'normal-user' => NormalUser::class,
            'company-user' => CompanyUser::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
