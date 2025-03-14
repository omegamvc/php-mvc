<?php

declare(strict_types=1);

namespace App\Kernels;

use System\Application\Application;
use System\Http\Kernel;
use System\Router\RouteDispatcher;
use System\Router\Router;
use Whoops\Handler\Handler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Http extends Kernel
{
    /** @var Run */
    private Run $run;

    /** @var Handler */
    private Handler $handler;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->app->bootedCallback(function () {
            if ($this->app->isDebugMode()) {
                /* @var PrettyPageHandler $handler */
                $this->handler = $this->app->make('error.PrettyPageHandler');
                $this->handler->setPageTitle('php mvc');

                /* @var Run $run */
                $this->run = $this->app->make('error.handle');
                $this->run
                  ->pushHandler($this->handler)
                  ->register();
            }
        });
    }

    protected function dispatcher($request): array
    {
        $dispatcher = new RouteDispatcher($request, Router::getRoutesRaw());

        $content = $dispatcher->run(
            // found
            fn ($callable, $param) => $this->app->call($callable, $param),
            // not found
            fn ($path) => view('pages/404', [
                'path'    => $path,
                'headers' => ['status' => 404],
            ]),
            // method not allowed
            fn ($path, $method) => view('pages/405', [
                'path'    => $path,
                'method'  => $method,
                'headers' => ['status' => 405],
            ])
        );

        return [
            'callable'   => $content['callable'],
            'parameters' => $content['params'],
            'middleware' => $content['middleware'],
        ];
    }
}
