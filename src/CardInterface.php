<?php

namespace Bingo;

interface CardInterface
{
    /**
     * @param int $number
     */
    public function visitNumber(int $number): void;

    /**
     * @return bool
     */
    public function checkAllVisited(): bool;

    public function print(): void;
}
