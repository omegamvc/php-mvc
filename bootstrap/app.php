<?php

declare(strict_types=1);

use App\Exceptions\Handler;
use App\Kernels\Cli;
use App\Kernels\Http;
use Dotenv\Dotenv;
use Omega\Console\CliKernel;
use Omega\Integrate\Application;
use Omega\Integrate\Exceptions\ExceptionHandler;
use Omega\Integrate\Http\HttpKernel;

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
