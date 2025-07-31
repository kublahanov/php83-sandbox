.NOTPARALLEL:

build:
	docker build --progress=plain --no-cache -t php83-composer:latest . && docker image prune -f

start:
	docker compose up -d

stop:
	docker compose down

.PHONY: build start stop
