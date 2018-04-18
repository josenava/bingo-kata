<?php

namespace Bingo;

class UsCardGenerator implements CardGeneratorInterface
{
    private const DIMENSIONS = [5, 5];
    private const RANGE = [
        'min' => 1,
        'max' => 75,
    ];

    private const FREE_SPACE_POSITION = [2, 2];

    public function generate(): CardInterface
    {
        $numbers = [];
        for ($i = 0; $i < self::DIMENSIONS[0]; $i++) {
            $numbers[$i] = RandomIntRange::create(
                $i*self::RANGE['max']/self::DIMENSIONS[0]+1,
                ($i+1)*self::RANGE['max']/self::DIMENSIONS[0],
                self::DIMENSIONS[0]
            );
            rsort($numbers[$i]);
        }
        $numbers[self::FREE_SPACE_POSITION[0]][self::FREE_SPACE_POSITION[1]] = 'X';

        return Card::fromNumbers($numbers);
    }

}
