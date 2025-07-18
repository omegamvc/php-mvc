<?php

declare(strict_types=1);

namespace Tests;

use System\Application\Application;

use function dirname;

trait CreateApplicationTrait
{
    public function createApplication(): Application
    {
        return require dirname(__DIR__) . '/bootstrap/app.php';
    }
}
