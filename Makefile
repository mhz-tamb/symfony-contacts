SHELL := /bin/bash

run:
	docker-compose up -d

migrate:
	docker-compose exec app php /var/www/app/bin/console doctrine:migrations:migrate -n

fixture:
	docker-compose exec app php /var/www/app/bin/console doctrine:fixtures:load -n
