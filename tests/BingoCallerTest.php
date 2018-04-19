<?php

namespace Tests;

use Bingo\BingoCaller;
use Bingo\Value\PositiveInt;
use PHPUnit\Framework\TestCase;

class BingoCallerTest extends TestCase
{
    public function testShout(): void
    {
        $min = PositiveInt::create(1);
        $max = PositiveInt::create(75);
        $bingoCaller = new BingoCaller($min, $max);
        $number = $bingoCaller->shoutNumber();

        $this->assertAttributeEquals(1, 'totalShouted', $bingoCaller);
        $this->assertAttributeContains($number, 'numbersToShout', $bingoCaller);
        $this->assertAttributeContains($number, 'shoutedNumbers', $bingoCaller);
    }

    public function testBingoCallerThrowsExceptionWithWrongRange(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $bingoCaller = new BingoCaller(PositiveInt::create(3), PositiveInt::create(1));
    }

    public function testGameEndsWhenAllNumbersShouted(): void
    {
        $min = PositiveInt::create(1);
        $max = PositiveInt::create(10);
        $bingoCaller = new BingoCaller($min, $max);

        for ($i = 0; $i < $max->value(); $i++) {
            $bingoCaller->shoutNumber();
        }

        $this->assertTrue($bingoCaller->endGame());
    }
}