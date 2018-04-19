#!/bin/bash

start-docker:
	docker-compose up -d
stop:
	docker-compose down
ssh:
	docker exec -it bingo-php sh
composer-install:
	docker exec -it bingo-php composer install
run-game-us:
	docker exec -it bingo-php php main.php us
