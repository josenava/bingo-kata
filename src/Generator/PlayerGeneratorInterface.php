<?php

namespace Bingo\Generator;

use Bingo\Player;

interface PlayerGeneratorInterface
{
    /**
     * @return Player[]
     */
    public function generate(): array;
}
