.NOTPARALLEL:

build:
	docker build --progress=plain --no-cache -t php83-composer .

start:
	docker compose up -d

stop:
	docker compose down -q

.PHONY: build start stop
