<?php

namespace Bingo;

use Bingo\Value\MatrixDimensions;

class Config
{
    /** @var string */
    private $version;
    /** @var int */
    private $minRange;
    /** @var int */
    private $maxRange;
    /** @var MatrixDimensions */
    private $dimensions;
    /** @var int */
    private $numPlayers;

    /**
     * @param string           $version
     * @param int              $minRange
     * @param int              $maxRange
     * @param MatrixDimensions $dimensions
     * @param int              $numPlayers
     */
    private function __construct(string $version, int $minRange, int $maxRange, MatrixDimensions $dimensions, int $numPlayers)
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

        return new self($argv[1], $argv[2], $argv[3], new MatrixDimensions($argv[4], $argv[5]), $argv[6]);
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return int
     */
    public function getMinRange(): int
    {
        return $this->minRange;
    }

    /**
     * @return int
     */
    public function getMaxRange(): int
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
     * @return int
     */
    public function getNumPlayers(): int
    {
        return $this->numPlayers;
    }
}