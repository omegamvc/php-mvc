<?php

declare(strict_types=1);

use App\Controllers\ApiController;
use System\Router\Router;

// Also support (json) format output
Router::any('/API/(:any)/(:any)', function ($unit, $action) {
    return (new ApiController())->index($unit, $action, 'v1.0');
});
