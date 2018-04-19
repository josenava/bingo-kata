<?php

namespace Tests;

use Bingo\Value\PositiveInt;
use PHPUnit\Framework\TestCase;

class PositiveIntTest extends TestCase
{
    public function testNegativeThrowsError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $num = -1;
        PositiveInt::create($num);
    }
}