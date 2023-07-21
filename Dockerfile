FROM php:7.4-fpm

RUN apt-get update && apt-get install -y git libcurl4-openssl-dev pkg-config libssl-dev zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

