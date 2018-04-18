<?php

namespace Bingo;

class Bingo
{
    private const MAX_NUM_PLAYERS = 1000;

    /** @var CardGeneratorInterface */
    private $cardGenerator;

    /** @var CardInterface[] */
    private $cards;

    /** @var int[] */
    private $numbers;

    /** @var int[] */
    private $visitedNumbers;

    /** @var CardInterface[] */
    private $winners;

    /**
     * @param CardGeneratorInterface $cardGenerator
     * @param int                    $numPlayers
     */
    public function __construct(CardGeneratorInterface $cardGenerator, int $numPlayers)
    {
        $this->cardGenerator = $cardGenerator;
        $this->createCards($numPlayers);
        $this->numbers = RandomIntRange::create(1, 75, 75);
        $this->visitedNumbers = [];
        $this->winners = [];
    }

    public function runGame(): void
    {
        $numbersCount = 0;
        while ($numbersCount < count($this->numbers) && count($this->winners) === 0) {
            $currentNumber = $this->numbers[$numbersCount];
            $numbersCount++;
            $this->visitedNumbers[] = $currentNumber;
            /** CardInterface $card */
            foreach ($this->cards as $card) {
                $card->visitNumber($currentNumber);
                if ($card->checkAllVisited()) {
                    $this->winners[] = $card;
                }
            }
        }
        echo sprintf('Total winners: %d', count($this->winners));
        echo 'Game ended'.PHP_EOL;
    }

    private function createCards(int $numPlayers)
    {
        if ($numPlayers > self::MAX_NUM_PLAYERS) {
            throw new \InvalidArgumentException(
                sprintf('Please provide a lower number of participants, max allowed is %d', self::MAX_NUM_PLAYERS)
            );
        }

        for ($i = 0; $i < $numPlayers; $i++) {
            $this->cards[] = $this->cardGenerator->generate();
        }
    }
}