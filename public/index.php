<?php

use DI\DependencyException;
use DI\NotFoundException;
use Omega\Http\RequestFactory;
use Omega\Integrate\Application;
use Omega\Http\HttpKernel;

if (file_exists($maintenance = dirname(__DIR__) . '/storage/app/maintenance.php')) {
    require $maintenance;
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** @var Application $app Load the Application. */
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';

/** @var HttpKernel $httpKernel Declare the HttpKernel. */
try {
    $httpKernel = $app->make(HttpKernel::class);
} catch (DependencyException|NotFoundException $e) {
    echo $e->getMessage();
}

/**
 * Handle Response from HttpKernel.
 */
$response = $httpKernel->handle(
    $request = (new RequestFactory())->getFromGlobal()
)->send();

$httpKernel->terminate($request, $response);
