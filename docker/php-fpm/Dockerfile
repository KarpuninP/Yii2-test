FROM php:7.4-fpm-alpine

RUN apk update && \
    apk add --no-cache autoconf dpkg-dev dpkg file g++ gcc libc-dev make pkgconf re2c && \
    apk add --no-cache php-dom libmcrypt-dev && \
    pecl install xdebug-2.9.8 && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install pdo_mysql



RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d
COPY www.conf /usr/local/etc/php-fpm.d/

USER 1000:1000

WORKDIR /var/www/app
