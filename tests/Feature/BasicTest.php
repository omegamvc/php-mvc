<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class BasicTest extends TestCase
{
    protected function tearDown(): void
    {
        restore_error_handler();
        restore_exception_handler();
    }

    /**
     * Test it can see welcome page.
     *
     * @return void
     */
    public function testItCanSeeWelcomePage(): void
    {
        $this
            ->get('/')
            ->assertOk();
    }
}
