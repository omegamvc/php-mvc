<?php

declare(strict_types=1);

namespace Tests;

use Omega\Integrate\Testing\TestCase as IntegrateTastCase;

abstract class TestCase extends IntegrateTastCase
{
    use CreateApplication;

    protected function setUp(): void
    {
        $this->app = $this->createApplication();
    }
}
