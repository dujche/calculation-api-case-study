FROM php:8.0-cli AS development

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        zip \
        git \
        symfony-cli \
        && pecl install xdebug \
        && docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

CMD [ "symfony", "server:start" ]

FROM development AS calculations-api

COPY ./src/ /var/www/html/src
COPY ./bin/ /var/www/html/bin
COPY ./config/ /var/www/html/config
COPY ./public/ /var/www/html/public
COPY ./composer.json /var/www/html
COPY ./.env /var/www/html

RUN composer install --no-dev && composer dump-autoload

CMD [ "symfony", "server:start" ]