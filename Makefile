build:
	docker build --no-cache -t php83-composer .

start:
	docker compose up -d

stop:
	docker compose down
