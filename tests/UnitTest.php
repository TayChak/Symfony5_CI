<?php

namespace App\Tests;

use App\Entity\Demo;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testDemo(): void
    {
        $demo = new Demo();

        $demo->setDemo('demo');

        $this->assertSame('demo', $demo->getDemo());
    }
}
