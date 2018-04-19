<?php

namespace Bingo;

use Bingo\Value\MatrixDimensions;
use PHPUnit\Framework\TestCase;

class MatrixDimensionsTest extends TestCase
{
    public function testThrowsExceptionWhenInvalidRowsOrColumns()
    {
        $this->expectException(\InvalidArgumentException::class);
        $rows = 0;
        $columns = 2;
        $matrixDimensions = new MatrixDimensions($rows, $columns);
    }
}