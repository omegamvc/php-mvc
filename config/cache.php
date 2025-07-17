<?php

return [
    'CACHE_STORAGE' => env('CACHE_STORAGE', 'file'),

    // redis driver
    'REDIS_HOST' => env('REDIS_HOST', '127.0.0.1'),
    'REDIS_PASS' => env('REDIS_PASS', ''),
    'REDIS_PORT' => env('REDIS_PORT', 6379),

    // memcahe
    'MEMCACHED_HOST' => env('MEMCACHED_HOST', '127.0.0.1'),
    'MEMCACHED_PASS' => env('MEMCACHED_PASS', ''),
    'MEMCACHED_PORT' => env('MEMCACHED_PORT', 6379),
];
