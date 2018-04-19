<?php

require __DIR__.'/vendor/autoload.php';

use \Bingo\Bingo;
use \Bingo\UsCardGenerator;
use \Bingo\BingoCaller;

if ($argc < 2) {
    throw new \InvalidArgumentException(sprintf('Usage %s %s', $argv[0], 'us/uk (bingo mode)'));
}
//todo check factory CardGeneratorFactory::create()
if ($argv[1] !== 'us') {
    // ready for implementing UKCardGenerator
    throw new \InvalidArgumentException('Mode not implemented yet.');
}

$cardGenerator = new UsCardGenerator(1, 75, [5, 5]);

$numPlayers = 200;
$bingo = new Bingo(
    new BingoCaller($cardGenerator->minRange(), $cardGenerator->maxRange()),
    $cardGenerator,
    $numPlayers
);

echo 'Hey the game just started!'.PHP_EOL;
$bingo->runGame();

echo 'Game ended'.PHP_EOL;
