.DEFAULT_GOAL := help

SYMFONY_BIN = symfony
YARN = yarn
COMPOSER = $(SYMFONY_BIN) composer
PHPUNIT = $(SYMFONY_BIN) php bin/phpunit
SYMFONY_CONSOLE = $(SYMFONY_BIN) console

.PHONY: run
run: ## Start local server
	@$(SYMFONY_BIN) serve

.PHONY: install assets
vendor: ## Install composer
	@$(COMPOSER) install

node_modules: yarn.lock ## Install node packages
	@$(YARN) install

assets: node_modules ## Run Webpack Encore to compile development assets
	@$(YARN) dev

install: vendor node_modules ## Install project
	make assets

## Help
.PHONY: help
help: ## Get command list
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
