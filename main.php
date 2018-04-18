<?php

require __DIR__.'/vendor/autoload.php';

use \Bingo\Bingo;
use \Bingo\UsCardGenerator;
use \Bingo\BingoCaller;

$numPlayers = 200;
$bingo = new Bingo(new BingoCaller(), new UsCardGenerator(), $numPlayers);

echo 'Hey the game just started!'.PHP_EOL;
$bingo->runGame();

echo 'Game ended'.PHP_EOL;
