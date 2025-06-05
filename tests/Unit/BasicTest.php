<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * Test if assert true is true.
     *
     * @return void
     */
    public function testIfAssertTrueIsTrue(): void
    {
        $this->assertTrue(true);
    }
}
