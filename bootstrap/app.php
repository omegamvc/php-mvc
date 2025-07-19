<?php

use App\Exceptions\Handler;
use App\Kernels\ConsoleKernel;
use App\Kernels\HttpKernel;
use System\Application\Application;
use System\Environment\Dotenv;

Dotenv::load(dirname(__DIR__));

$app = new Application(dirname(__DIR__));

$app->set(
    System\Integrate\Http\Karnel::class,
    fn() => new HttpKernel($app)
);

$app->set(
    System\Integrate\Console\Karnel::class,
    fn () => new ConsoleKernel($app)
);

$app->set(
    System\Integrate\Exceptions\Handler::class,
    fn () => new Handler($app)
);

return $app;
