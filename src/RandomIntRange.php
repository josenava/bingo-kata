<?php

namespace Bingo;

class RandomIntRange
{
    /**
     * @param int $min
     * @param int $max
     * @param int $length
     *
     * @return int[]
     *
     * @throws \Exception
     */
    public static function create(int $min, int $max, int $length): array
    {
        self::validate($min, $max, $length);
        $range = range($min, $max);
        shuffle($range);

        return array_slice($range, 0, $length);
    }

    /**
     * @param int $min
     * @param int $max
     * @param int $length
     *
     * @return bool
     *
     * @throws \Exception
     */
    public static function validate(int $min, int $max, int $length): bool
    {
        if ($min >= $max || $length <= 0) {
            throw new \InvalidArgumentException();
        }

        return true;
    }
}
