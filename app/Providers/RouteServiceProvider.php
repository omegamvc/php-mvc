<?php

declare(strict_types=1);

namespace App\Providers;

use App\Middlewares\AppMiddleware;
use DI\DependencyException;
use DI\NotFoundException;
use System\Container\ServiceProvider\AbstractServiceProvider;
use System\Router\Router;

use function System\Application\base_path;

class RouteServiceProvider extends AbstractServiceProvider
{
    /**
     * @throws DependencyException
     * @throws NotFoundException
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
