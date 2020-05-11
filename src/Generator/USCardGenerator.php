<?php

namespace Bingo\Generator;

use Bingo\Card;
use Bingo\CardInterface;
use Bingo\Value\MatrixDimensions;
use Bingo\Value\PositiveInt;
use Bingo\Value\RandomIntRange;

class USCardGenerator implements CardGeneratorInterface
{
    private const FREE_SPACE_POSITION = [2, 2];

    /** @var int */
    private $maxRange;
    /** @var MatrixDimensions */
    private $dimensions;

    /**
     * @param PositiveInt      $maxRange
     * @param MatrixDimensions $dimensions
     */
    public function __construct(PositiveInt $maxRange, MatrixDimensions $dimensions)
    {
        $this->maxRange = $maxRange->value();
        $this->dimensions = $dimensions;
    }

    /**
     * @return CardInterface
     *
     * @throws \Exception
     */
    public function generate(): CardInterface
    {
        $cardNumberMatrix = [];
        for ($column = 0; $column < $this->dimensions->getColumns(); $column++) {
            $cardNumberMatrix[$column] = RandomIntRange::create(
                $column*$this->maxRange/$this->dimensions->getColumns()+1,
                ($column+1)*$this->maxRange/$this->dimensions->getColumns(),
                $this->dimensions->getRows()
            );
            rsort($cardNumberMatrix[$column]);
        }
        $cardNumberMatrix[self::FREE_SPACE_POSITION[0]][self::FREE_SPACE_POSITION[1]] = 'X';

        return new Card($cardNumberMatrix);
    }
}
