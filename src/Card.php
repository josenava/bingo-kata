<?php

class Card implements CardInterface
{
    /** @var array */
    private $checkedNumbers;
    /** @var array */
    private $numbers;
    /** @var int */
    private $totalChecked;

    private function __construct()
    {
        $this->checkedNumbers = [];
        $this->totalChecked = 0;
    }

    public static function fromNumbers(array $numbers): self
    {
        $card = new self();
        $card->setNumbers($numbers);

        return $card;
    }

    /**
     * @param array $numbers
     */
    public function setNumbers(array $numbers): void
    {
        $this->numbers = $numbers;
    }

    /**
     * @param int $number
     */
    public function visitNumber(int $number): void
    {
        foreach ($this->numbers as $row) {
            if (in_array($number, $row, true)) {
                $this->checkedNumbers[] = $number;
                $this->totalChecked++;
                break;
            }
        }
    }

    /**
     * @return bool
     */
    public function checkAllVisited(): bool
    {
        return $this->totalChecked === count($this->numbers)**2-1;
    }

    public function print(): void
    {
        for ($i = 0; $i < count($this->numbers); $i++) {
            for ($j = count($this->numbers[0]) - 1; $j >= 0; $j--) {
                echo $this->numbers[$i][$j].' ';
            }
            echo PHP_EOL;
        }
        echo sprintf('Checked numbers: %s', implode(' ', $this->checkedNumbers));
    }
}