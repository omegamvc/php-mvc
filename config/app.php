<?php

return [
    'BASEURL'           => env('BASEURL', 'http://localhost'),
    'TIMEZONE'          => env('TIME_ZONE', ''),
    'APP_KEY'           => env('APP_KEY', ''),
    'ENVIRONMENT'       => env('APP_ENV', 'dev'),
    'APP_DEBUG'         => (bool) env('APP_DEBUG', ''),

    'BCRYPT_ROUNDS'     => (bool) env('BCRYPT_ROUNDS', 12),
    'CONFIG_STORAGE'    => env('file', 'file'),

    'PROVIDERS'         => [
        App\Providers\AppServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\DatabaseServiceProvider::class,
        App\Providers\ViewServiceProvider::class,
        App\Providers\CacheServiceProvider::class,
    ],
];
