FROM php:8.3-fpm-alpine
LABEL authors="https://github.com/kublahanov"

# Устанавливаем CLI поверх FPM
RUN apk add --no-cache php83-cli

# Зависимости (выполняем от root)
RUN apk add --no-cache \
    git unzip curl bash postgresql-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PHP-расширения
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS linux-headers \
    && docker-php-ext-install pdo pdo_pgsql bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

# Настраиваем пользователя (под ваш UID на хосте)
ARG USER_ID=1000
ARG GROUP_ID=1000
RUN apk add --no-cache shadow && \
    usermod -u $USER_ID www-data && \
    groupmod -g $GROUP_ID www-data

# Создаем структуру папок с правильными правами
RUN mkdir -p /var/www/html/public && \
    chown -R www-data:www-data /var/www

WORKDIR /var/www
USER www-data
