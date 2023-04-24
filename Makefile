CONTAINER_NAME=symfony-examples-doctrine-fixture

ifneq (, $(shell which podman 2> /dev/null))
CONTAINER_ENGINE=podman
endif

ifneq (, $(shell which docker 2> /dev/null))
CONTAINER_ENGINE=docker
endif

###
# Container commands
###
.PHONY: build, run
build: ## Build container for podman
	${CONTAINER_ENGINE} build -t ${CONTAINER_NAME} .

run: ## Run container for podman
	${CONTAINER_ENGINE} run --rm -it -v ${PWD}:/var/www/symfony --privileged -p 8000:8000 ${CONTAINER_NAME} bash


###
# Project commands
###

install:
	$(MAKE) build
	${CONTAINER_ENGINE} run --rm -it -v ${PWD}:/var/www/symfony --privileged ${CONTAINER_NAME} composer install -n

###
# Quality tools
###

.PHONY: fix, phpstan, unit, check-all
fix: ## Run php cs fixer for podman
	${CONTAINER_ENGINE} run --rm -it -v ${PWD}:/var/www/symfony --privileged ${CONTAINER_NAME} vendor/bin/php-cs-fixer fix

phpstan: ## Run phpstan for podman
	${CONTAINER_ENGINE} run --rm -it -v ${PWD}:/var/www/symfony --privileged ${CONTAINER_NAME} vendor/bin/phpstan

unit: ## Run phpstan for podman
	${CONTAINER_ENGINE} run --rm -it -v ${PWD}:/var/www/symfony --privileged ${CONTAINER_NAME} vendor/bin/phpunit

check-all: ## Run all tests for podman
	$(MAKE) fix
	$(MAKE) phpstan
	$(MAKE) unit
