<?php

return [
    'BASEURL'        => env('BASEURL', 'http://localhost'),
    'timezone'       => env('TIME_ZONE', 'UTC'),
    'APP_KEY'        => env('APP_KEY', ''),
    'ENVIRONMENT'    => env('APP_ENV', 'dev'),
    'APP_DEBUG'      => (bool) env('APP_DEBUG', ''),
    'BCRYPT_ROUNDS'  => (bool) env('BCRYPT_ROUNDS', 12),
    'CONFIG_STORAGE' => env('file', 'file'),
];
