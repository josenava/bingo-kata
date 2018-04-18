<?php

namespace Tests;

use Bingo\RandomIntRange;
use PHPUnit\Framework\TestCase;

class RandomIntRangeTest extends TestCase
{
    public function testThrowsErrorWhenWrongParameters(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $min = 7;
        $max = 5;
        RandomIntRange::create($min, $max, 20);
    }
}