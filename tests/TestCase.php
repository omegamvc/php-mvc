<?php

declare(strict_types=1);

namespace Tests;

use Omega\Application\Application;
use Omega\Testing\TestCase as IntegrateTastCase;
use Whoops\Run;

abstract class TestCase extends IntegrateTastCase
{
    use CreateApplicationTrait;

    protected function setUp(): void
    {
        $this->app = $this->createApplication();
    }
}
