<?php

namespace Tests;

use Bingo\Generator\USCardGenerator;
use Bingo\Value\MatrixDimensions;
use Bingo\Value\PositiveInt;
use PHPUnit\Framework\TestCase;

class USCardGeneratorTest extends TestCase
{
    public function testGeneratesUSBingoCard(): void
    {
        $maxRange = PositiveInt::create(75);
        $columns = PositiveInt::create(5);
        $rows = PositiveInt::create(5);
        $cardGenerator = new USCardGenerator(
            $maxRange,
            new MatrixDimensions($rows, $columns)
        );
        $card = $cardGenerator->generate();

        $this->assertCount($columns->value()*$rows->value()-1, $card->numbers());
    }
}
