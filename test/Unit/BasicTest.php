<?php

declare(strict_types=1);

namespace Test\Unit;

use Test\TestCase;

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
