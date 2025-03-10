<?php

declare(strict_types=1);

use DI\DependencyException;
use DI\NotFoundException;
use System\Http\RequestFactory;
use System\Application\Application;
use System\Integrate\Http\Kernel;

if (file_exists($maintenance = dirname(__DIR__) . '/storage/app/maintenance.php')) {
    require $maintenance;
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Load Application instance.
 *
 * @var Application $app
 */
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';

/**
 * Declare http kernel.
 *
 * @var Kernel $kernel
 */
try {
    $kernel = $app->make(Kernel::class);
} catch (DependencyException|NotFoundException $e) {
}

/**
 * Handle Response from http kernel.
 */
$response = $kernel->handle(
    $request = (new RequestFactory())->getFromGlobal()
)->send();

$kernel->terminate($request, $response);
