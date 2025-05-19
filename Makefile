TARGET_APP=stat-an:dev

## To init project
.PHONY: init
init:
	$(MAKE) build
	cp .env.example .env
	cp docker/php-fpm/xdebug.ini.example docker/php-fpm/xdebug.ini
	$(MAKE) install db-init

## Build docker image
.PHONY: build
build:
	DOCKER_BUILDKIT=1 docker build \
		-f docker/php-fpm/Dockerfile \
		--target dev \
		-t $(TARGET_APP) \
		.

## Install dependencies
.PHONY: install
install:
	docker-compose -f docker-compose.yaml run --rm stat-an-api composer install

## Init database
.PHONY: db-init
db-init:
	docker-compose run --rm stat-an-api sh -c "php bin/console doctrine:migrations:migrate -n"

## Start containers
.PHONY: start
start:
	docker-compose -f docker-compose.yaml up -d

## Stop containers
.PHONY: stop
stop:
	docker-compose -f docker-compose.yaml down

.PHONY: shell
shell:
	docker-compose -f docker-compose.yaml exec stat-an-api sh

## Display container status
.PHONY: status
status:
	docker-compose -f docker-compose.yaml ps

## Display logs of all containers
.PHONY: logs
logs:
	docker-compose -f docker-compose.yaml logs -f

## Run static code analyses with phpstan
.PHONY: static-check
static-check:
	docker-compose -f docker-compose.yaml run --rm stat-an-api php -d memory_limit=4G vendor/bin/phpstan analyse -c phpstan.neon

## Run linter analyses with php-cs-fixer
.PHONY: style-check
style-check:
	docker-compose -f docker-compose.yaml run -e PHP_CS_FIXER_IGNORE_ENV=1 --rm stat-an-api php -d memory_limit=4G vendor/bin/php-cs-fixer fix --dry-run --diff --show-progress=dots

## Run linter automatic fix with php-cs-fixer
.PHONY: style-fix
style-fix:
	docker-compose -f docker-compose.yaml run -e PHP_CS_FIXER_IGNORE_ENV=1 --rm stat-an-api php -d memory_limit=4G vendor/bin/php-cs-fixer fix --diff --show-progress=dots