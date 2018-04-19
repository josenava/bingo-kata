<?php

namespace Bingo;

class Card implements CardInterface
{
    /** @var array */
    private $matrix;

    /** @var int[] */
    private $flattenNumbers;

    /**
     * @param array $numbers
     */
    public function __construct(array $numbers)
    {
        $this->matrix = $numbers;
        $this->setFlattenNumbers();
    }


    /**
     * @return array
     */
    public function flattenNumbers(): array
    {
        return $this->flattenNumbers;
    }

    public function print(): void
    {
        for ($j = count($this->matrix[0]) - 1; $j >= 0; $j--) {
            for ($i = 0; $i < count($this->matrix); $i++) {
                echo $this->matrix[$i][$j].' ';
            }
            echo PHP_EOL;
        }
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    public function contains(int $number): bool
    {
        return in_array($number, $this->flattenNumbers);
    }

    private function setFlattenNumbers(): void
    {
        $flattenMatrix = array_reduce(
            $this->matrix,
            function (array $carry, array $row) {
                return array_merge($carry, $row);
            },
            []
        );

        $this->flattenNumbers = array_filter($flattenMatrix, function ($element) {
            return is_int($element);
        });
    }
}