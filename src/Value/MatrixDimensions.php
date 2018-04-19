<?php

namespace Bingo\Value;

class MatrixDimensions
{
    /** @var int */
    private $columns;
    /** @var int */
    private $rows;

    /**
     * @param PositiveInt $rows
     * @param PositiveInt $columns
     */
    public function __construct(PositiveInt $rows, PositiveInt $columns)
    {
        $this->rows = $rows->value();
        $this->columns = $columns->value();
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
}
