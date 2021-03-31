FROM php:8.0-fpm-alpine

RUN apk --update --no-cache add git icu-dev
RUN docker-php-ext-install intl pdo_mysql

WORKDIR /var/www/app
COPY --from=composer /usr/bin/composer /usr/bin/composer
CMD composer install; php-fpm