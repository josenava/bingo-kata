<?php

namespace Bingo\Generator;

use Bingo\CardInterface;

interface CardGeneratorInterface
{
    /**
     * @return CardInterface
     */
    public function generate(): CardInterface;

    /**
     * @return int
     */
    public function minRange(): int;

    /**
     * @return int
     */
    public function maxRange(): int;
}