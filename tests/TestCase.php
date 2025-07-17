<?php

declare(strict_types=1);

namespace Tests;

use System\Integrate\Testing\TestCase as IntegrateTestCase;

abstract class TestCase extends IntegrateTestCase
{
    use CreateApplicationTrait;

    protected function setUp(): void
    {
        $this->app = $this->createApplication();
    }
}
