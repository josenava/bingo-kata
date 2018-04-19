<?php

namespace Bingo\Generator;

use Bingo\Player;

class PlayerGenerator implements PlayerGeneratorInterface
{
    public const MAX_NUM_PLAYERS = 1000;

    /** @var CardGeneratorInterface */
    private $cardGenerator;
    /** @var int */
    private $numPlayers;

    /**
     * @param CardGeneratorInterface $cardGenerator
     * @param int                    $numPlayers
     */
    public function __construct(CardGeneratorInterface $cardGenerator, int $numPlayers)
    {
        $this->cardGenerator = $cardGenerator;
        $this->numPlayers = $numPlayers;
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