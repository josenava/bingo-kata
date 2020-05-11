<?php

namespace Bingo\Value;

final class PositiveInt
{
    /** @var int  */
    private $number;

    /**
     * @param int $number
     */
    private function __construct(int $number)
    {
        $this->setNumber($number);
    }

    /**
     * @param int $number
     *
     * @return PositiveInt
     */
    public static function create(int $number): self
    {
        return new self($number);
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @throws \Exception
     */
    private function setNumber(int $number): void
    {
        if ($number < 1) {
            throw new \InvalidArgumentException('Please enter a positive int');
        }

        $this->number = $number;
    }
}
