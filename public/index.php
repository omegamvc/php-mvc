<?php

declare(strict_types=1);

use System\Application\Application;
use System\Integrate\Http\Kernel;
use System\Http\RequestFactory;

if (file_exists($maintenance = dirname(__DIR__) . '/storage/app/maintenance.php')) {
    require $maintenance;
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** @var Application $app Load Application instance. */
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';

/** @var Kernel $kernel Declare the HTTP Kernel. */
$kernel = $app->make(Kernel::class);

/**
 * Handle Response from HTTP Kernel.
 */
$response = $kernel->handle($request = (new RequestFactory())->getFromGlobal())->send();

$kernel->terminate($request, $response);
