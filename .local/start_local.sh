#!/bin/bash

# Скрипт для запуска Docker Compose в фоновом режиме

docker compose -f ./../docker/docker-compose.yml up -d
