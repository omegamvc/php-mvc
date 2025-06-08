<?php

declare(strict_types=1);

namespace Test\Feature;

use Test\TestCase;

class BasicTest extends TestCase
{
    /**
     * Test it can see welcome page.
     *
     * @return void
     */
    public function testItCanSeeWelcomePage(): void
    {
        $response = $this->get('/welcome');

        $response->assertOk();
    }
}
