<?php

declare(strict_types=1);

namespace Tests;

use System\Integrate\Application;

use function dirname;

trait CreateApplication
{
    public function createApplication(): Application
    {
        return require dirname(__DIR__) . '/bootstrap/app.php';
    }
}
