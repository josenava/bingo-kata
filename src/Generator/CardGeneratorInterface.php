<?php

namespace Bingo\Generator;

use Bingo\CardInterface;

interface CardGeneratorInterface
{
    /**
     * @return CardInterface
     */
    public function generate(): CardInterface;
}