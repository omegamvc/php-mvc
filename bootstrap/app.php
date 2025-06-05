<?php

declare(strict_types=1);

use App\Exceptions\Handler;
use App\Kernels\Cli;
use App\Kernels\Http;
use Dotenv\Dotenv;
use System\Integrate\Application;
use System\Integrate\Console\CliKernel;
use System\Integrate\Exceptions\ExceptionHandler;
use System\Integrate\Http\HttpKernel;

Dotenv::createImmutable(dirname(__DIR__))->load();

$app = new Application(dirname(__DIR__));

$app->set(
    HttpKernel::class,
    fn() => new Http($app)
);

$app->set(
    CliKernel::class,
    fn () => new Cli($app)
);

$app->set(
    ExceptionHandler::class,
    fn () => new Handler($app)
);

return $app;
