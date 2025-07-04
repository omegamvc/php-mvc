<?php

declare(strict_types=1);

return [
    'DB_HOST' => env('DB_HOST', 'localhost'),
    'DB_USER' => env('DB_USER', 'root'),
    'DB_PASS' => env('DB_PASS') ?: 'vb65ty4',
    'DB_NAME' => env('DB_NAME', 'phpmvc'),
];
