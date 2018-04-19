<?php

namespace Bingo;

use Bingo\Generator\CardGeneratorInterface;
use Psr\Log\LoggerInterface;

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
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param BingoCallerInterface   $bingoCaller
     * @param CardGeneratorInterface $cardGenerator
     * @param LoggerInterface        $logger
     * @param int                    $numPlayers
     */
    public function __construct(
        BingoCallerInterface $bingoCaller,
        CardGeneratorInterface $cardGenerator,
        LoggerInterface $logger,
        int $numPlayers
    ) {
        $this->cardGenerator = $cardGenerator;
        $this->enrollPlayers($numPlayers);
        $this->winners = [];
        $this->bingoCaller = $bingoCaller;
        $this->logger = $logger;
    }

    public function runGame(): void
    {
        $this->logger->info('Hey the game is about to start, get ready!');
        while (!$this->bingoCaller->endGame()) {
            $currentNumber = $this->bingoCaller->shoutNumber();
            $this->logger->info(sprintf('Shouted: %d', $currentNumber));
            /** Player $player */
            foreach ($this->players as $player) {
                $player->checkNumber($currentNumber);
                if ($player->checkAllCrossed() && $this->bingoCaller->checkWinnerNumbers($player->getCard()->flattenNumbers())) {
                    $this->winners[] = $player;
                }
            }
        }
        $this->logger->info(sprintf(
            'Winners: %s',
            implode(' ', array_map(function (Player $player) { return (string) $player;}, $this->winners))
        ));

        $this->logger->info('The game just finished.');
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