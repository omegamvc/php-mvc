<?php

/**
 * Omega Application.
 *
 * @link       https://omegamvc.github.io
 * @author     Adriano Giovannini <agisoftt@gmail.com>
 * @copyright  Copyright (c) 2024 - 2025 Adriano Giovannini (https://omegamvc.github.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 */

declare(strict_types=1);

use App\Exceptions\Handler;
use App\Kernels\ConsoleKernel;
use App\Kernels\HttpKernel;
use Dotenv\Dotenv;
use System\Application\Application;
use System\Integrate\Console\Kernel as KernelConsole;
use System\Integrate\Exceptions\Handler as ExceptionHandler;
use System\Integrate\Http\Kernel as KernelHttp;

Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

$app = Application::getInstance($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));

$app->set(KernelHttp::class, fn() => new HttpKernel($app));
$app->set(KernelConsole::class, fn () => new ConsoleKernel($app));
$app->set(ExceptionHandler::class, fn () => new Handler($app));

return $app;
