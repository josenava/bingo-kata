<?php

namespace Bingo;

class BingoCaller implements BingoCallerInterface
{
    /** @var int[] */
    private $numbersToShout;
    /** @var int[] */
    private $shoutedNumbers;
    /** @var int */
    private $totalShouted;
    /** @var bool */
    private $existsWinner;


    /**
     * @param int $minRange
     * @param int $maxRange
     */
    public function __construct(int $minRange, int $maxRange)
    {
        $this->numbersToShout = RandomIntRange::create($minRange, $maxRange, $maxRange);
        $this->shoutedNumbers = [];
        $this->totalShouted = 0;
        $this->existsWinner = false;
    }
    /**
     * @return int
     */
    public function shoutNumber(): int
    {
        $number = $this->numbersToShout[$this->totalShouted];
        $this->shoutedNumbers[] = $number;
        $this->totalShouted++;

        return $number;
    }

    /**
     * @param array $numbers
     *
     * @return bool
     */
    public function checkWinnerNumbers(array $numbers): bool
    {
        $this->existsWinner = count(array_intersect($this->shoutedNumbers, $numbers)) === count($numbers);

        return $this->existsWinner;
    }

    /**
     * @return bool
     */
    public function endGame(): bool
    {
        return $this->totalShouted === count($this->numbersToShout) || $this->existsWinner;
    }
}