#!/bin/bash

# Скрипт для остановки Docker Compose с удалением томов и неиспользуемых контейнеров

docker compose -f ./../docker/docker-compose.yml down -v --remove-orphans
