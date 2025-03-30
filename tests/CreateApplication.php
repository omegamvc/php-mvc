<?php

declare(strict_types=1);

namespace Tests;

use System\Application\Application;

trait CreateApplication
{
    public function createApplication(): Application
    {
        $app = require dirname(__DIR__) . '/bootstrap/app.php';

        return $app;
    }
}
