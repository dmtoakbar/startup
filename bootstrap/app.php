<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureAdminLogged;
use App\Http\Middleware\ClearCacheInfo;
use App\Http\Middleware\EnsureAdminLogout;
use App\Http\Middleware\RestrictAdminUser;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'ensureAdminLogged' => EnsureAdminLogged::class,
         'clearCacheInfo' => ClearCacheInfo::class,
         'ensureAdminLogout' => EnsureAdminLogout::class,
          'restrictAdminUser' => RestrictAdminUser::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
