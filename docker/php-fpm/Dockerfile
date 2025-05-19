ARG PHP_VERSION=8.4

FROM php:${PHP_VERSION}-fpm-alpine AS prod

ARG UID=1000
ARG GID=1000

ENV UID=${UID}
ENV GID=${GID}

ARG STABILITY="stable"
ENV STABILITY=${STABILITY}

ARG SYMFONY_VERSION=""
ENV SYMFONY_VERSION=${SYMFONY_VERSION}

ENV APP_ENV=prod

WORKDIR /var/www

RUN apk add postgresql postgresql-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apk add --no-cache \
		acl \
		fcgi \
		file \
		gettext \
		git \
	;

RUN set -eux; \
    apk update; \
	apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
        linux-headers \
		icu-data-full \
		icu-dev \
		libzip-dev \
		zlib-dev \
	; \
	\
	docker-php-ext-configure zip; \
	docker-php-ext-install -j$(nproc) \
		intl \
		zip \
    	sockets \
	; \
	pecl install \
		apcu \
        excimer \
	; \
	pecl clear-cache; \
	docker-php-ext-enable \
		apcu \
        excimer \
		opcache \
	; \
	\
	runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
	apk add --no-cache --virtual .app-phpexts-rundeps $runDeps; \
	\
	apk del .build-deps

COPY docker/php-fpm/ini/prod.ini /usr/local/etc/php/conf.d/local.ini
COPY docker/php-fpm/99-www-override.conf /usr/local/etc/php-fpm.d/99-www-override.conf

CMD ["php-fpm", "--nodaemonize"]

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer:2.8.9 /usr/bin/composer /usr/bin/composer

COPY composer.* symfony.* ./

RUN set -eux; \
    if [ -f composer.json ]; then \
		composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress; \
		composer clear-cache; \
    fi

COPY src /var/www/src
COPY bin /var/www/bin
COPY migrations /var/www/migrations
COPY config /var/www/config
COPY public /var/www/public

COPY .env.example /var/www/.env

RUN addgroup -g ${GID} www
RUN adduser -u ${UID} -s /bin/sh -D -G www www

RUN chown -R www:www /var/www
USER www

RUN set -eux; \
	mkdir -p var/cache var/log; \
    if [ -f composer.json ]; then \
		composer dump-autoload --classmap-authoritative --no-dev; \
		composer dump-env prod; \
		composer run-script --no-dev post-install-cmd; \
		chmod +x bin/console; sync; \
    fi

FROM prod AS dev

USER root

RUN apk --no-cache add linux-headers pcre-dev ${PHPIZE_DEPS}
RUN pecl install xdebug-3.4.3

RUN docker-php-ext-enable xdebug
RUN apk del linux-headers pcre-dev ${PHPIZE_DEPS}

USER www

#COPY .php-cs-fixer.php /var/www/.php-cs-fixer.php
#COPY phpstan.neon /var/www/phpstan.neon
#COPY phpstan.stub /var/www/phpstan.stub

RUN composer install