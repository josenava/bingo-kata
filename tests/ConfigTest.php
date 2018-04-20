<?php

namespace Tests;

use Bingo\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testThrowsErrorWhenIncorrectAmountOfArgs(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $args = [];

        Config::fromArgs($args);
    }

    public function testThrowsErrorWhenRangesAreNotPositiveInt(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $args = ['main.php', 'us', -1, -1, -2, -1, -1];

        Config::fromArgs($args);
    }
}
