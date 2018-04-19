<?php

namespace Bingo\Value;

class MatrixDimensions
{
    /** @var int */
    private $columns;
    /** @var int */
    private $rows;

    /**
     * @param int $rows
     * @param int $columns
     */
    public function __construct(int $rows, int $columns)
    {
        $this->validate($rows, $columns);
        $this->rows = $rows;
        $this->columns = $columns;
    }

    /**
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * @return int
     */
    public function getColumns(): int
    {
        return $this->columns;
    }

    /**
     * @param int $min
     * @param int $max
     *
     * @return bool
     */
    private function validate(int $min, int $max): bool
    {
        if ($min < 1 || $max < 1) {
            throw new \InvalidArgumentException('Please provide bigger dimensions for the matrix');
        }

        return true;
    }
}