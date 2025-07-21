FROM php:8.3-cli-alpine
LABEL authors="https://github.com/kublahanov"

# Устанавливаем зависимости + Composer
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    bash \
    postgresql-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PHP-расширения для Laravel + PostgreSQL
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    linux-headers \
    && docker-php-ext-install pdo pdo_pgsql bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

WORKDIR /var/www

CMD ["tail", "-f", "/dev/null"]
