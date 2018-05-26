.SILENT:
.PHONY: help

## Colors
COLOR_RESET   = \033[0m
COLOR_INFO    = \033[32m
COLOR_COMMENT = \033[33m

## Defaults
DIR := ${CURDIR}

## Help
help:
	printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	printf " make [target]\n\n"
	printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	awk '/^[a-zA-Z\-\_0-9\.@]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf " ${COLOR_INFO}%-16s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

## install
install: env composer database yarn asset warmup

env: .env.dist
	cp .env.dist .env

composer: composer.json
	composer install

database:
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create

yarn: package.json
	yarn install

asset:
	yarn build

warmup:
	php bin/console cache:warmup --env=${APP_ENV}

## start dev
start:
	php -S 127.0.0.1:8000 -t public

## start functionnal tests
tests-func:
	yarn cypress:open

## start functionnal tests
tests-unit:
	php bin/phpunit --configuration phpunit.xml.dist