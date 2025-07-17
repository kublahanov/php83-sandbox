FROM php:8.3-cli
LABEL authors="https://github.com/kublahanov"

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN docker-php-ext-install pdo pdo_mysql

CMD ["tail", "-f", "/dev/null"]
