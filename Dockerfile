FROM ubuntu:latest
LABEL authors="https://github.com/kublahanov"

ENTRYPOINT ["top", "-b"]

## Используем официальный образ PHP 8.3 с Composer
#FROM php:8.3-cli
#
## Устанавливаем зависимости для Composer и PHP
#RUN apt-get update && apt-get install -y \
#    git \
#    unzip \
#    && rm -rf /var/lib/apt/lists/*
#
## Устанавливаем Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#
## Рабочая директория (здесь будут проекты)
#WORKDIR /var/www
#
## Опционально: добавляем нужные PHP-расширения (для Laravel/Symfony)
#RUN docker-php-ext-install pdo pdo_mysql
#
## Команда по умолчанию (можно переопределить при запуске)
#CMD ["tail", "-f", "/dev/null"]
