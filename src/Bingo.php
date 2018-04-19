<?php

namespace Bingo;

use Bingo\Generator\CardGeneratorInterface;
use Bingo\Generator\PlayerGeneratorInterface;
use Psr\Log\LoggerInterface;

class Bingo
{
    /** @var Player[] */
    private $players;
    /** @var BingoCallerInterface */
    private $bingoCaller;
    /** @var Player[] */
    private $winners;
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param BingoCallerInterface     $bingoCaller
     * @param PlayerGeneratorInterface $playerGenerator
     * @param LoggerInterface          $logger
     */
    public function __construct(
        BingoCallerInterface $bingoCaller,
        PlayerGeneratorInterface $playerGenerator,
        LoggerInterface $logger
    ) {
        $this->players = $playerGenerator->generate();
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
                if ($player->checkAllCrossed() && $this->bingoCaller->checkWinnerNumbers($player->getCard()->numbers())) {
                    $this->winners[] = $player;
                }
            }
        }
        foreach ($this->winners as $winner) {
            $this->logger->info(sprintf('Winner card: %s', $winner->getCard()));
        }

        $this->logger->info('The game just finished.');
    }
}
