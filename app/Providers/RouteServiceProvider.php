<?php

declare(strict_types=1);

namespace App\Providers;

use App\Middlewares\AppMiddleware;
use Omega\Container\Provider\AbstractServiceProvider;
use Omega\Router\Router;

class RouteServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        Router::middleware([
            // middleware
            AppMiddleware::class,
        ])->group(
            fn () => [
                require_once base_path('/routes/web.php'),
                require_once base_path('/routes/api.php'),
            ]
        );

        require_once base_path('/routes/schedule.php');
    }
}
