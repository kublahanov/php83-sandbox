FROM caddy:2.7-alpine
LABEL authors="https://github.com/kublahanov"

# Просто создаем папки - Caddy сам разберется с правами
RUN mkdir -p /data/caddy/pki

# Копируем Caddyfile
COPY ./etc/Caddyfile /etc/caddy/Caddyfile
