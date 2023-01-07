FROM composer:latest as composer

ARG CI_ENV=dev
ENV APP_ENV=$CI_ENV

USER root

WORKDIR /srv/app

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN	if [ "$APP_ENV" != 'prod' ] && [ -e "composer.json" ]; then \
    composer install \
    --ignore-platform-reqs \
    --no-progress \
    --no-interaction \
    --ansi \
    --no-scripts; \
    fi

RUN	if [ "$APP_ENV" = "prod" ] && [ -e "composer.json" ]; then \
    composer install \
    --ignore-platform-reqs \
    --no-dev \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --no-progress \
    --no-interaction \
    --optimize-autoloader \
    --ansi; \
    fi

RUN	if [ "$APP_ENV" = "prod" ] && [ -e "composer.json" ]; then \
    composer dump-autoload \
    --no-scripts \
    --no-dev \
    --optimize \
    --ansi; \
    fi

FROM php:8.2.1-fpm-alpine AS php8-fpm

USER root

WORKDIR /srv/app

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli

COPY --chown=www-data . ./
COPY --chown=www-data --from=composer /srv/app /srv/app

#RUN set -eux; \
#	mkdir -p var/cache var/log; \
#	chmod +x bin/console; sync

RUN chown -R www-data:www-data /srv/app

CMD ["php-fpm"]