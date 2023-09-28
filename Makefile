start:
	concurrently "php artisan serve" "npm run dev"

up: start

# api
api-install:
	cp $(CURDIR)/.env.example $(CURDIR)/.env && composer install --working-dir=$(CURDIR)/api

api-config:
	php artisan config:cache

migrate: api-config
	php artisan migrate

api-key-generate:
	php artisan key:generate

api-setup: api-install api-key-generate api-config migrate

	
# front
# front-install: 
# 	yarn --cwd $(CURDIR)/front install

setup: api-setup #front-install

# other
db-refresh:
	php artisan migrate:fresh && php artisan db:seed

# test: 
# 	 @echo "test"