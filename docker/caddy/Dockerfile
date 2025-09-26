FROM caddy:2.7-alpine
LABEL authors="https://github.com/kublahanov"

# Меняем пользователя на вашего
ARG USER_ID=1000
ARG GROUP_ID=1000
RUN addgroup -g $GROUP_ID caddy-user && \
    adduser -u $USER_ID -G caddy-user -D caddy-user

USER caddy-user

COPY ./etc/ /etc/caddy/
