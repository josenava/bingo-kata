<?php

namespace Bingo;

class Card implements CardInterface
{
    /** @var array */
    private $matrix;
    /** @var int[] */
    private $numbers;

    /**
     * @param array $cardNumberMatrix
     */
    public function __construct(array $cardNumberMatrix)
    {
        $this->matrix = $cardNumberMatrix;
        $this->setNumbersFromMatrix();
    }

    /**
     * @return array
     */
    public function numbers(): array
    {
        return $this->numbers;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $card = '';
        for ($j = count($this->matrix[0]) - 1; $j >= 0; $j--) {
            for ($i = 0; $i < count($this->matrix); $i++) {
                $card .= $this->matrix[$i][$j].' ';
            }
            $card .= PHP_EOL;
        }

        return $card;
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    public function contains(int $number): bool
    {
        return in_array($number, $this->numbers);
    }

    private function setNumbersFromMatrix(): void
    {
        $flattenMatrix = array_reduce(
            $this->matrix,
            function (array $carry, array $row) {
                return array_merge($carry, $row);
            },
            []
        );
        // removes the "free spaces"
        $this->numbers = array_filter($flattenMatrix, function ($element) {
            return is_int($element);
        });
    }
}
