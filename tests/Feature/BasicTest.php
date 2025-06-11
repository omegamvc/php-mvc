<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class BasicTest extends TestCase
{
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