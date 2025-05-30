<?php

declare(strict_types=1);

namespace App\Providers;

use App\Middlewares\AppMiddleware;
use System\Container\ServiceProvider\AbstractServiceProvider;
use System\Router\Router;

class RouteServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        Router::middleware([
            // middleware
            AppMiddleware::class,
        ])->group(
            fn () => [
                require_once get_base_path('/routes/web.php'),
                require_once get_base_path('/routes/api.php'),
            ]
        );

        require_once get_base_path('/routes/schedule.php');
    }
}
