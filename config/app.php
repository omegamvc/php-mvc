<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\CacheServiceProvider;
use App\Providers\DatabaseServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Providers\ViewServiceProvider;
use Omega\Support\Path;

return [
    'BASEURL'           => env('BASEURL', 'http://localhost:8080'),
    'TIME_ZONE'         => env('TIME_ZONE', 'Europe/Rome' ),
    'APP_KEY'           => env('APP_KEY', ''),
    'APP_ENV'           => env('APP_ENV', 'dev'),
    'APP_DEBUG'         => env('APP_DEBUG', false),

    'BCRYPT_ROUNDS'     => env('BCRYPT_ROUNDS', 12),
    'CONFIG_STORAGE'    => env('file', 'file'),

    'VIEW_PATH'         => Path::getPath('resources.views'),
    'CACHE_VIEW_PATH'   => Path::getPath('storage.app.view'),

    'PROVIDERS'         => [
        AppServiceProvider::class,
        RouteServiceProvider::class,
        DatabaseServiceProvider::class,
        ViewServiceProvider::class,
        CacheServiceProvider::class,
    ],
];
