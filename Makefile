CONTAINER_NAME=symfony-examples-doctrine-fixture

###############################################################################
# Podman commands
###############################################################################

###
# Container commands
###
.PHONY: pbuild, prun
pbuild: ## Build container for podman
	podman build -t ${CONTAINER_NAME} .

prun: ## Run container for podman
	podman run --rm -it -v ${PWD}:/var/www/symfony --privileged -p 8000:8000 ${CONTAINER_NAME} bash

###
# Quality tools
###
.PHONY: pfix, pstan, punit, pcheck-all
pfix: ## Run php cs fixer for podman
	podman run --rm -it -v ${PWD}:/var/www/symfony --privileged ${CONTAINER_NAME} vendor/bin/php-cs-fixer fix

pstan: ## Run phpstan for podman
	podman run --rm -it -v ${PWD}:/var/www/symfony --privileged ${CONTAINER_NAME} vendor/bin/phpstan

punit: ## Run phpstan for podman
	podman run --rm -it -v ${PWD}:/var/www/symfony --privileged ${CONTAINER_NAME} vendor/bin/phpunit

pcheck-all: ## Run all tests for podman
	$(MAKE) pfix
	$(MAKE) pstan
	$(MAKE) punit
