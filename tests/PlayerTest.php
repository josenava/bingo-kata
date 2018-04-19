<?php

namespace Tests;

use Bingo\Card;
use Bingo\Player;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

final class PlayerTest extends TestCase
{
    public function testCheckAllCrossedReturnsTrue()
    {
        $numbers = [1, 2, 3, 4, 5, 16, 17, 18, 19, 20, 31, 32, 34, 35, 36, 46, 47, 48, 49, 50, 61, 62, 63, 64];
        $cardProphecy = $this->prophesize(Card::class);
        $cardProphecy->numbers()->willReturn($numbers);
        $cardProphecy->contains(Argument::type('int'))->willReturn(true);

        $player = new Player($cardProphecy->reveal());

        foreach ($numbers as $number) {
            $player->checkNumber($number);
        }

        $this->assertTrue($player->checkAllCrossed());
    }
}