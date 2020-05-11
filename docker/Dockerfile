FROM php:7.2-cli-alpine3.7

COPY install-composer.sh /usr/local/bin/install-composer
RUN chmod +x /usr/local/bin/install-composer \
    && /usr/local/bin/install-composer

RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative \
	&& composer clear-cache

WORKDIR /bingo-kata
