<?php

namespace Bingo;


interface BingoCallerInterface
{
    /**
     * @return int
     */
    public function shoutNumber(): int;

    /**
     * @param array $numbers
     *
     * @return bool
     */
    public function checkWinnerNumbers(array $numbers): bool;

    /**
     * @return bool
     */
    public function endGame(): bool;
}
