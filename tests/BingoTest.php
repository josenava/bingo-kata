<?php

namespace Tests;

use Bingo\Bingo;
use Bingo\BingoCaller;
use Bingo\CardInterface;
use Bingo\Generator\CardGeneratorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class BingoTest extends TestCase
{
    public function testNumberPlayersBiggerThanLimitThrowsError(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $bingoCallerProphecy = $this->prophesize(BingoCaller::class);
        $cardGeneratorProphecy = $this->prophesize(CardGeneratorInterface::class);
        $loggerProphecy = $this->prophesize(LoggerInterface::class);
        $numPlayers = Bingo::MAX_NUM_PLAYERS+1;

        $bingo = new Bingo(
            $bingoCallerProphecy->reveal(),
            $cardGeneratorProphecy->reveal(),
            $loggerProphecy->reveal(),
            $numPlayers
        );
    }
}