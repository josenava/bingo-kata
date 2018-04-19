<?php

require __DIR__.'/vendor/autoload.php';

use \Bingo\Bingo;
use Bingo\Generator\USCardGenerator;
use \Bingo\BingoCaller;
use \Bingo\Config;
use \Monolog\Logger;

if ($argv[1] === '--help') {
    echo sprintf(
        'Usage php %s %s %s %s %s %s %s',
        $argv[0],
        'us/uk(version uk not implemented yet)',
        'min_range_of_card_numbers',
        'max_range_of_card_numbers',
        'number_of_columns_in_the_card',
        'number_of_rows_in_the_card',
        'number_of_players'
    );
    exit;
}

try {
    $config = Config::fromArgs($argv);
    $logger = new Logger('Bingo');
    // as there is only an implementation for US rules, it is assigned here, otherwise it would be
    // taken from $config->getVersion()
    $cardGenerator = new USCardGenerator($config->getMaxRange(), $config->getDimensions());

    $bingo = new Bingo(
        new BingoCaller($config->getMinRange(), $config->getMaxRange()),
        $cardGenerator,
        $logger,
        $config->getNumPlayers()
    );

    $bingo->runGame();
} catch (\Exception $exception) {
    $logger->error($exception->getMessage());
}
