<?php

declare(strict_types=1);

use App\Controllers\IndexController;
use System\Router\Router;

Router::get('/', [IndexController::class, 'index']);

Router::get('/say/(:any)', function ($text) {
    return "say $text";
});
