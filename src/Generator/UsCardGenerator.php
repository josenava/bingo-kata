<?php

namespace Bingo\Generator;

use Bingo\Card;
use Bingo\CardInterface;
use Bingo\Value\RandomIntRange;

class UsCardGenerator implements CardGeneratorInterface
{
    private const FREE_SPACE_POSITION = [2, 2];

    /** @var int */
    private $minRange;
    /** @var int */
    private $maxRange;
    /** @var array */
    private $dimensions;

    /**
     * @param int   $minRange
     * @param int   $maxRange
     * @param array $dimensions
     */
    public function __construct(int $minRange, int $maxRange, array $dimensions)
    {
        $this->minRange = $minRange;
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
        $numbers = [];
        for ($i = 0; $i < $this->dimensions[0]; $i++) {
            $numbers[$i] = RandomIntRange::create(
                $i*$this->maxRange/$this->dimensions[0]+1,
                ($i+1)*$this->maxRange/$this->dimensions[0],
                $this->dimensions[0]
            );
            rsort($numbers[$i]);
        }
        $numbers[self::FREE_SPACE_POSITION[0]][self::FREE_SPACE_POSITION[1]] = 'X';

        return new Card($numbers);
    }
}
