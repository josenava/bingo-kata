<?php

namespace Bingo;

class Player
{
    /** @var CardInterface */
    private $card;
    /** @var int[] */
    private $crossedNumbers;

    /**
     * @param CardInterface $card
     */
    public function __construct(CardInterface $card)
    {
        $this->card = $card;
        $this->crossedNumbers = [];
    }

    /**
     * @return CardInterface
     */
    public function getCard(): CardInterface
    {
        return $this->card;
    }

    /**
     * @param int $number
     */
    public function checkNumber(int $number): void
    {
        if ($this->card->contains($number)) {
            $this->crossedNumbers[] = $number;
        }
    }

    /**
     * @return bool
     */
    public function checkAllCrossed(): bool
    {
        return count(array_diff($this->card->numbers(), $this->crossedNumbers)) === 0;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('[%s]', implode(',', $this->crossedNumbers));
    }
}