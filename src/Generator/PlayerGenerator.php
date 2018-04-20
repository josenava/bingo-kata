<?php

namespace Bingo\Generator;

use Bingo\Player;
use Bingo\Value\PositiveInt;

class PlayerGenerator implements PlayerGeneratorInterface
{
    public const MAX_NUM_PLAYERS = 1000;

    /** @var CardGeneratorInterface */
    private $cardGenerator;
    /** @var int */
    private $numPlayers;

    /**
     * @param CardGeneratorInterface $cardGenerator
     * @param PositiveInt            $numPlayers
     */
    public function __construct(CardGeneratorInterface $cardGenerator, PositiveInt $numPlayers)
    {
        $this->cardGenerator = $cardGenerator;
        $this->numPlayers = $numPlayers->value();
    }

    /**
     * @return Player[]
     *
     * @throws \InvalidArgumentException
     */
    public function generate(): array
    {
        if ($this->numPlayers > self::MAX_NUM_PLAYERS) {
            throw new \InvalidArgumentException(
                sprintf('Please provide a lower number of participants, max allowed is %d', self::MAX_NUM_PLAYERS)
            );
        }

        $players = [];
        for ($i = 0; $i < $this->numPlayers; $i++) {
            $players[] = new Player($this->cardGenerator->generate());
        };

        return $players;
    }
}
