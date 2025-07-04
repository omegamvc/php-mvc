<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\CacheServiceProvider;
use App\Providers\DatabaseServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Providers\ViewServiceProvider;

return [
    'BASEURL'           => env('BASEURL', 'http://localhost:8080'),
    'TIME_ZONE'         => env('TIME_ZONE', 'Europe/Rome' ),
    'APP_KEY'           => env('APP_KEY', ''),
    'APP_ENV'           => env('APP_ENV', 'dev'),
    'APP_DEBUG'         => env('APP_DEBUG', false),

    'BCRYPT_ROUNDS'     => env('BCRYPT_ROUNDS', 12),
    'CONFIG_STORAGE'    => env('file', 'file'),

    'CACHE_VIEW_PATH'       => DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR,

    'PROVIDERS'         => [
        AppServiceProvider::class,
        RouteServiceProvider::class,
        DatabaseServiceProvider::class,
        ViewServiceProvider::class,
        CacheServiceProvider::class,
    ],
];
