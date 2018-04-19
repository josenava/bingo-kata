<?php

namespace Tests;

use Bingo\BingoCaller;
use PHPUnit\Framework\TestCase;

class BingoCallerTest extends TestCase
{
    public function testShout(): void
    {
        $min = 1;
        $max = 75;
        $bingoCaller = new BingoCaller($min, $max);
        $number = $bingoCaller->shoutNumber();

        $this->assertAttributeEquals(1, 'totalShouted', $bingoCaller);
        $this->assertAttributeContains($number, 'numbersToShout', $bingoCaller);
        $this->assertAttributeContains($number, 'shoutedNumbers', $bingoCaller);
    }

    public function testBingoCallerThrowsExceptionWithWrongRange(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $bingoCaller = new BingoCaller(3, 1);
    }

    public function testGameEndsWhenAllNumbersShouted(): void
    {
        $min = 1;
        $max = 10;
        $bingoCaller = new BingoCaller($min, $max);

        for ($i = 0; $i < $max; $i++) {
            $bingoCaller->shoutNumber();
        }

        $this->assertTrue($bingoCaller->endGame());
    }
}