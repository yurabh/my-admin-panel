#!/usr/bin/make
# Variables
DC = docker compose
APP = $(DC) exec app

# Default goal
.DEFAULT_GOAL := help

help: ## Show this help message
	@printf "\033[33m%s:\033[0m\n" 'Available commands'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z0-9_-]+:.*?## / {printf "  \033[32m%-18s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

init: ## Creates default .env files for api/backend and web/frontend
	cat .env

up: ## Start all containers in detached mode
	$(DC) up -d

down: ## Stop and remove all containers
	$(DC) down

restart: ## Restart all docker services
	$(DC) restart

build: ## Rebuild docker images without cache
	$(DC) build --no-cache

shell: ## Open a terminal inside the app container
	$(APP) sh

migrate: ## Run pending database migrations
	$(APP) php artisan migrate

migrate-step: ## Rollback the last migration and run it again
	$(APP) php artisan migrate:rollback --step=1
	$(APP) php artisan migrate

seed: ## Populate the database with seed data
	$(APP) php artisan db:seed

fresh: ## Wipe the database and run all migrations with seeds
	$(APP) php artisan migrate:fresh --seed

tinker: ## Enter the interactive Artisan Tinker shell
	$(APP) php artisan tinker

cache: ## Clear all Laravel application caches (config, route, view, etc.)
	$(APP) php artisan cache:clear
	$(APP) php artisan config:clear
	$(APP) php artisan route:clear
	$(APP) php artisan view:clear

test: ## Run the application test suite
	$(APP) php artisan test

xdebug-status: ## Check Xdebug status inside the app container
	$(APP) php -v
