FROM php:8.2-fpm-alpine as local

WORKDIR /var/www/symfony

RUN apk add --no-cache bash \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

EXPOSE 8000

### CI STAGE
FROM local as ci

### SYMFONY REQUIREMENT
RUN apk add --no-cache icu-dev \
  && docker-php-ext-install intl \
  && docker-php-ext-enable intl \
  && docker-php-ext-install opcache \
  && docker-php-ext-enable opcache

COPY ./.container/symfony.ini /usr/local/etc/php/conf.d/
### =================

### IMAGE HEALTHCHECK
HEALTHCHECK --interval=5s --timeout=3s --retries=3 CMD symfony check:req
### =================

### INSTALL DEPENDENCIES
COPY composer.json composer.lock symfony.lock ./
RUN set -eux; \
    composer install --prefer-dist --no-progress --no-scripts --no-interaction --optimize-autoloader;
### =================

### COPY PROJECT FILES AND DIRECTORY
COPY bin bin/
COPY config config/
COPY migrations migrations/
COPY public public/
COPY src src/
COPY tests tests/
COPY .env .env.test .php-cs-fixer.dist.php phpstan.neon phpunit.xml.dist ./
### =================

### INSTALL DEPENDENCIES WITH SCRIPTS
RUN set -eux; \
    composer install --prefer-dist --no-interaction --no-scripts --no-progress; \
    composer run-script post-install-cmd \
    composer clear-cache
### =================
