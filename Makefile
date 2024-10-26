.DEFAULT_GOAL := build
SHELL := bash

app = docker compose run --rm php

build:
	docker compose build --pull
	$(app) mkdir --parents build
	$(app) composer install

.PHONY: clean
clean:
	$(app) -rf ./build ./vendor
