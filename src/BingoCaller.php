<?php

namespace Bingo;

use Bingo\Value\PositiveInt;
use Bingo\Value\RandomIntRange;

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
     * @param PositiveInt $minRange
     * @param PositiveInt $maxRange
     *
     * @throws \Exception
     */
    public function __construct(PositiveInt $minRange, PositiveInt $maxRange)
    {
        $this->numbersToShout = RandomIntRange::create(
            $minRange->value(),
            $maxRange->value(),
            $maxRange->value()
        );
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
