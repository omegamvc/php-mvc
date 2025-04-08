<?php

namespace Tests;

use System\Testing\TestCase as IntegrateTastCase;
use Tests\CreateApplication;

abstract class TestCase extends IntegrateTastCase
{
    use CreateApplication;

    protected function setUp(): void
    {
        $this->app = $this->createApplication();
    }
}
