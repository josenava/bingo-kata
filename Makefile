#!/bin/bash

start-docker:
	docker-compose up -d
stop-docker:
	docker-compose down
ssh:
	docker exec -it bingo-php sh
composer-install:
	docker exec -it bingo-php composer install
run-game-us:
	docker exec -it bingo-php php main.php us 1 75 5 5 200
run-tests:
	docker exec -it bingo-php vendor/bin/phpunit --bootstrap vendor/autoload.php tests/*
