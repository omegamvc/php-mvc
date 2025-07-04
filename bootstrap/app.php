<?php

declare(strict_types=1);

use App\Exceptions\Handler;
use App\Kernels\Cli;
use App\Kernels\Http;
use Omega\Console\CliKernel;
use Omega\Application\Application;
use Omega\Environment\Dotenv;
use Omega\Exceptions\ExceptionHandler;
use Omega\Http\HttpKernel;

Dotenv::load(dirname(__DIR__));

//$app = new Application(dirname(__DIR__));
$app = Application::getInstance(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

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
