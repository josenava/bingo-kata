<?php

namespace Tests;

use Bingo\Generator\USCardGenerator;
use Bingo\Value\MatrixDimensions;
use PHPUnit\Framework\TestCase;

class USCardGeneratorTest extends TestCase
{
    public function testGeneratesUSBingoCard(): void
    {
        $maxRange = 75;
        $columns = 5;
        $rows = 5;
        $cardGenerator = new USCardGenerator($maxRange, new MatrixDimensions($rows, $columns));
        $card = $cardGenerator->generate();

        $this->assertCount($columns*$rows-1, $card->numbers());
    }
}