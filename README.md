# bingo-kata
https://agilekatas.co.uk/katas/Bingo-Kata

Bingo game kata in PHP7.2

###Installation guide:
If you have PHP7.2 just run `composer install` and
`php main.php us 1 75 5 5 200`.

Parameters explained:
- `us` -> Bingo mode, right now is the only one implemented.
- `1` -> Minimum range for the card.
- `75` -> Maximum range for the card.
- `5` -> rows for the card.
- `5` -> columns for the card.
- `200` -> number of players.

Right now all those parameters are passed to `main.php` script but ideally they should
be read from a config file which will contain the rules of the US Bingo.

In case you want to use docker, there are a couple of commands in the Makefile:
- `make start-docker`
- `make composer-install`
- `make run-game-us`
- `make run-tests`