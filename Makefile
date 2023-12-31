.PHONY: help clean localserve local-serve-with-output local-shell

# the following 3 lines are critical - do not alter or remove them!
# makes entire target/recipe execute within a single bash process.
.ONESHELL:
export SHELL := /bin/bash
export SHELLOPTS := $(if $(SHELLOPTS),$(SHELLOPTS):)errexit:pipefail

# make docker use buildkit, and make docker-compose use docker cli, for support of multi-stage builds from Dockerfile
export DOCKER_BUILDKIT=1
export COMPOSE_DOCKER_CLI_BUILD=1
NETWORK_NAME=csproject

help:
	@: noop to silence command echoing
	printf "Usage:\n make [target]\n\nAvailable targets:\n"
	awk '/^[a-zA-Z\-\_0-9\.@]+:/ { \
		if (helpMessage = match(lastLine, /^## (.*)/)) { \
			printf " %-28s$ %s\n", substr($$1, 0, index($$1, ":")), substr(lastLine, RSTART + 3, RLENGTH); \
		} \
	} { lastLine = $$0 }' $(MAKEFILE_LIST)

clean:
	docker-compose -p csproject_auth down --rmi local --volumes

check_network:
	- docker network create --driver bridge $(NETWORK_NAME)

setup-dev: check_network
	docker-compose -p csproject_auth down --rmi local --volumes
	docker-compose -f docker-compose-dev.yml -p csproject_auth up -d --build
	docker exec -it auth_api composer install

setup-local: check_network
	docker-compose -p csproject_auth down --rmi local --volumes
	docker-compose -f docker-compose-local.yml -p csproject_auth up -d --build
	docker exec -it auth_api composer install

unit-test-local:
	php ./vendor/bin/phpunit --testsuit Unit

unit-test-container:
	docker exec -it api composer install && \
	php ./vendor/bin/phpunit --testsuit Unit
