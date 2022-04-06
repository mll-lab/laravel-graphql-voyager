.PHONY: it
it: vendor fix stan ## Run useful checks before commits

.PHONY: help
help: ## Displays this list of targets with descriptions
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(firstword $(MAKEFILE_LIST)) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: setup
setup: vendor ## Setup the local environment

.PHONY: fix
fix: ## Fix code style
	vendor/bin/php-cs-fixer fix

.PHONY: stan
stan: ## Runs static analysis
	vendor/bin/phpstan

vendor: composer.json ## Install composer dependencies
	composer update
	composer validate --strict
	composer normalize
