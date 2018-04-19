<?php

namespace Bingo\Generator;

use Bingo\Card;
use Bingo\CardInterface;
use Bingo\Value\RandomIntRange;

class USCardGenerator implements CardGeneratorInterface
{
    private const FREE_SPACE_POSITION = [2, 2];

    /** @var int */
    private $maxRange;
    /** @var array */
    private $dimensions;

    /**
     * @param int   $maxRange
     * @param array $dimensions
     */
    public function __construct(int $maxRange, array $dimensions)
    {
        $this->maxRange = $maxRange;
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
        for ($i = 0; $i < $this->dimensions[0]; $i++) {
            $cardNumberMatrix[$i] = RandomIntRange::create(
                $i*$this->maxRange/$this->dimensions[0]+1,
                ($i+1)*$this->maxRange/$this->dimensions[0],
                $this->dimensions[0]
            );
            rsort($cardNumberMatrix[$i]);
        }
        $cardNumberMatrix[self::FREE_SPACE_POSITION[0]][self::FREE_SPACE_POSITION[1]] = 'X';

        return new Card($cardNumberMatrix);
    }
}
