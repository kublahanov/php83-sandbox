FROM postgres:15-alpine
LABEL authors="https://github.com/kublahanov"

# Получаем переменные из build-args
ARG DB_DATABASE
ARG DB_USERNAME
ARG DB_PASSWORD

# Устанавливаем envsubst
RUN apk add --no-cache gettext

# Копируем и обрабатываем SQL
COPY ./initdb/ /tmp/initdb/
RUN for f in /tmp/initdb/*.sql; do \
    DB_DATABASE="$DB_DATABASE" \
    DB_USERNAME="$DB_USERNAME" \
    DB_PASSWORD="$DB_PASSWORD" \
    envsubst < "$f" > "/docker-entrypoint-initdb.d/$(basename "$f")"; \
    done
