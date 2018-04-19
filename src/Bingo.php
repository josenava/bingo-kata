<?php

namespace Bingo;

use Bingo\Generator\CardGeneratorInterface;

class Bingo
{
    private const MAX_NUM_PLAYERS = 1000;

    /** @var CardGeneratorInterface */
    private $cardGenerator;

    /** @var Player[] */
    private $players;

    /** @var BingoCallerInterface */
    private $bingoCaller;

    /** @var Player[] */
    private $winners;

    /**
     * @param BingoCallerInterface   $bingoCaller
     * @param CardGeneratorInterface $cardGenerator
     * @param int                    $numPlayers
     */
    public function __construct(
        BingoCallerInterface $bingoCaller,
        CardGeneratorInterface $cardGenerator,
        int $numPlayers
    ) {
        $this->cardGenerator = $cardGenerator;
        $this->enrollPlayers($numPlayers);
        $this->winners = [];
        $this->bingoCaller = $bingoCaller;
    }

    public function runGame(): void
    {
        while (!$this->bingoCaller->endGame()) {
            $currentNumber = $this->bingoCaller->shoutNumber();
            echo sprintf('Shouted: %d', $currentNumber).PHP_EOL;
            /** Player $player */
            foreach ($this->players as $player) {
                $player->checkNumber($currentNumber);
                if ($player->checkAllCrossed() && $this->bingoCaller->checkWinnerNumbers($player->getCard()->flattenNumbers())) {
                    $this->winners[] = $player;
                }
            }
        }
        echo sprintf(
            'Winners: %s',
            implode(' ', array_map(function (Player $player) { return (string) $player;}, $this->winners))
        ).PHP_EOL;
    }

    /**
     * @param int $numPlayers
     */
    private function enrollPlayers(int $numPlayers): void
    {
        if ($numPlayers > self::MAX_NUM_PLAYERS) {
            throw new \InvalidArgumentException(
                sprintf('Please provide a lower number of participants, max allowed is %d', self::MAX_NUM_PLAYERS)
            );
        }

        for ($i = 0; $i < $numPlayers; $i++) {
            $this->players[] = new Player($this->cardGenerator->generate());
        }
    }
}