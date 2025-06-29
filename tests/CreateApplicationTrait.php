<?php

declare(strict_types=1);

namespace Tests;

use Omega\Application\Application;

use function dirname;

trait CreateApplicationTrait
{
    public function createApplication(): Application
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }
}
