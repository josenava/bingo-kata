<?php

namespace Bingo;

use Bingo\Value\MatrixDimensions;
use Bingo\Value\PositiveInt;

final class Config
{
    /** @var string */
    private $version;
    /** @var PositiveInt */
    private $minRange;
    /** @var PositiveInt */
    private $maxRange;
    /** @var MatrixDimensions */
    private $dimensions;
    /** @var PositiveInt */
    private $numPlayers;

    /**
     * @param string           $version
     * @param PositiveInt      $minRange
     * @param PositiveInt      $maxRange
     * @param MatrixDimensions $dimensions
     * @param PositiveInt      $numPlayers
     */
    private function __construct(
        string $version,
        PositiveInt $minRange,
        PositiveInt $maxRange,
        MatrixDimensions $dimensions,
        PositiveInt $numPlayers
    )
    {
        $this->version = $version;
        $this->minRange = $minRange;
        $this->maxRange = $maxRange;
        $this->dimensions = $dimensions;
        $this->numPlayers = $numPlayers;
    }

    /**
     * @param array $argv
     *
     * @return Config
     *
     * @throws \Exception
     */
    public static function fromArgs(array $argv): self
    {
        if (count($argv) < 7) {
            throw new \InvalidArgumentException(sprintf('Wrong usage please check --help'));
        }
        if ($argv[1] !== 'us') {
            // ready for implementing UKCardGenerator
            throw new \InvalidArgumentException('Mode not implemented yet.');
        }
        $minRange = PositiveInt::create($argv[2]);
        $maxRange = PositiveInt::create($argv[3]);
        $rows = PositiveInt::create($argv[4]);
        $columns = PositiveInt::create($argv[5]);
        $numPlayers = PositiveInt::create($argv[6]);

        return new self(
            $argv[1],
            $minRange,
            $maxRange,
            new MatrixDimensions($rows, $columns),
            $numPlayers
        );
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return PositiveInt
     */
    public function getMinRange(): PositiveInt
    {
        return $this->minRange;
    }

    /**
     * @return PositiveInt
     */
    public function getMaxRange(): PositiveInt
    {
        return $this->maxRange;
    }

    /**
     * @return MatrixDimensions
     */
    public function getDimensions(): MatrixDimensions
    {
        return $this->dimensions;
    }

    /**
     * @return PositiveInt
     */
    public function getNumPlayers(): PositiveInt
    {
        return $this->numPlayers;
    }
}