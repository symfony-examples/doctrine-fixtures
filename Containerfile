FROM php:8.2-fpm-alpine

WORKDIR /var/www/symfony

RUN apk add --no-cache bash \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

EXPOSE 8000