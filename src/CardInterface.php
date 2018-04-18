<?php

namespace Bingo;

interface CardInterface
{
    public function print(): void;

    /**
     * @param int $number
     *
     * @return bool
     */
    public function contains(int $number): bool;

    /**
     * @return array
     */
    public function flattenNumbers(): array;
}
