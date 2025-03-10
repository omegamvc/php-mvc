<?php

use App\Exceptions\Handler;
use App\Kernels\Cli;
use App\Kernels\Http;
use Dotenv\Dotenv;
use System\Application\Application;
use System\Integrate\Console\Kernel as ConsoleKernel;
use System\Integrate\Exceptions\Handler as ExceptionsHandler;
use System\Integrate\Http\Kernel as HttpKernel;

Dotenv::createImmutable(dirname(__DIR__))->load();

$app = new Application(dirname(__DIR__));

$app->set(
    HttpKernel::class,
    fn() => new Http($app)
);

$app->set(
    ConsoleKernel::class,
    fn() => new Cli($app)
);

$app->set(
    ExceptionsHandler::class,
    fn() => new Handler($app)
);

return $app;
