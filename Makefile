.RECIPEPREFIX +=
.DEFAULT_GOAL := help

#COLORS
GREEN  := $(shell tput -Txterm setaf 2)
RED    := $(shell tput -Txterm setaf 1)
WHITE  := $(shell tput -Txterm setaf 7)
YELLOW := $(shell tput -Txterm setaf 3)
RESET  := $(shell tput -Txterm sgr0)

# Add the following 'help' target to your Makefile
# And add help text after each target name starting with '\#\#'
# A category can be added with @category
HELP_FUN = \
        %help; \
        while(<>) { push @{$$help{$$2 // 'options'}}, [$$1, $$3] if /^([a-zA-Z\-]+)\s*:.*\#\#(?:@([a-zA-Z\-]+))?\s(.*)$$/ }; \
        print "usage: make [target]\n\n"; \
        for (sort keys %help) { \
        print "${WHITE}$$_:${RESET}\n"; \
        for (@{$$help{$$_}}) { \
        $$sep = " " x (32 - length $$_->[0]); \
        print "  ${YELLOW}$$_->[0]${RESET}$$sep${GREEN}$$_->[1]${RESET}\n"; \
        }; \
        print "\n"; }

.PHONY: help build test analyse lint

help: ##@other Show this help
	@perl -e '$(HELP_FUN)' $(MAKEFILE_LIST)

build: test analyse lint ##@development Executes different build tools: static codeanalysis, Linting and unit tests

analyse: ##@development Executes the static code analyser
	vendor/bin/phpstan analyse -l 9 src test

lint-dry: ##@development Executes the linter without fixing any errors
	vendor/bin/php-cs-fixer fix --dry-run --diff src

lint: ##@development Executes the linter
	vendor/bin/php-cs-fixer fix --diff src

test: ##@development Executes the Unit Test suite
	vendor/bin/phpunit test

watch: ##@other Executes the build step, if a php file in the src/ directory is changed
	find src/ | entr make build

watch-tests: ##@other Executes the build step, if a php file in the test/ directory is changed
	find test/ | entr make build

run: ##@development Runs the server
	php -S localhost:8000 -t public/

setup: ##@development setups the Project
	composer install