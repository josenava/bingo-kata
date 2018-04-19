<?php

namespace Tests;

use Bingo\Bingo;
use Bingo\BingoCaller;
use Bingo\Card;
use Bingo\Generator\CardGeneratorInterface;
use Bingo\Generator\PlayerGeneratorInterface;
use Bingo\Player;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class BingoTest extends TestCase
{
    public function testRunGameWhenPlayerHasBingo(): void
    {
        $cardProphecy = $this->prophesize(Card::class);
        $cardProphecy->numbers()->willReturn([1]);
        $cardProphecy->__toString()->willReturn('[1]');
        $card = $cardProphecy->reveal();

        $cardGeneratorProphecy = $this->prophesize(CardGeneratorInterface::class);
        $cardGeneratorProphecy->generate()->willReturn($card);

        $playerProphecy = $this->prophesize(Player::class);
        $playerProphecy->checkNumberInCard(1)->shouldBeCalled();
        $playerProphecy->checkAllCrossed()->willReturn(true);
        $playerProphecy->getCard()->willReturn($card);
        $player = $playerProphecy->reveal();

        $playerGeneratorProphecy = $this->prophesize(PlayerGeneratorInterface::class);
        $playerGeneratorProphecy->generate()->willReturn([$player]);
        $bingoCallerProphecy = $this->prophesize(BingoCaller::class);
        $bingoCallerProphecy->endGame()->willReturn(false, true);
        $bingoCallerProphecy->shoutNumber()->willReturn(1);
        $bingoCallerProphecy->checkWinnerNumbers([1])->willReturn(true);

        $loggerProphecy = $this->prophesize(LoggerInterface::class);


        $bingo = new Bingo(
            $bingoCallerProphecy->reveal(),
            $playerGeneratorProphecy->reveal(),
            $loggerProphecy->reveal()
        );

        $bingo->runGame();

        $this->assertAttributeCount(1, 'winners', $bingo);
    }
}