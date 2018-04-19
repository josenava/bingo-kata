<?php

namespace Tests;

use Bingo\Card;
use Bingo\Generator\CardGeneratorInterface;
use Bingo\Generator\PlayerGenerator;
use Bingo\Value\PositiveInt;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PlayerGeneratorTest extends TestCase
{
    public function testGenerateThrowsErrorWhenMorePlayersThanExpected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $cardProphecy = $this->prophesize(Card::class);
        $card = $cardProphecy->reveal();

        $cardGeneratorProphecy = $this->prophesize(CardGeneratorInterface::class);
        $cardGeneratorProphecy->generate()->willReturn($card);

        $maxPlayers = PositiveInt::create(PlayerGenerator::MAX_NUM_PLAYERS+1);
        $playerGenerator = new PlayerGenerator($cardGeneratorProphecy->reveal(), $maxPlayers);

        $playerGenerator->generate();
    }

    public function testGenerateReturnsPlayerArray(): void
    {
        $cardProphecy = $this->prophesize(Card::class);
        $card = $cardProphecy->reveal();

        $cardGeneratorProphecy = $this->prophesize(CardGeneratorInterface::class);
        $cardGeneratorProphecy->generate()->willReturn($card);

        $maxPlayers = PositiveInt::create(1);
        $playerGenerator = new PlayerGenerator($cardGeneratorProphecy->reveal(), $maxPlayers);

        $players = $playerGenerator->generate();

        $this->assertCount(1, $players);
    }
}