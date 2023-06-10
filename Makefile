OS := $(shell uname)

install:
	sh ./install.sh

build:
	docker-compose -f docker-compose.yaml -f docker-compose-dev.yaml build

start:
	docker volume create --name=symfony-cqrs-api-vendor-sync
	docker volume create --name=symfony-cqrs-api-app-sync
	docker-compose -f docker-compose.yaml -f docker-compose-dev.yaml up -d --remove-orphans
	docker-sync start -f

stop:
	docker-compose stop
	docker-sync stop

sync_clean:
	docker-sync clean

execphp:
	docker-compose exec symfony-cqrs-php bash

execdb:
	docker-compose exec symfony-cqrs-mysql bash

copy_vendor:
	rm -r ./vendor
	docker-compose cp symfony-cqrs-php:/app/vendor/ ./vendor

run_tests:
	docker-compose exec -T symfony-cqrs-php-test vendor/bin/phpunit

run_phpstan:
	docker-compose exec -T symfony-cqrs-php vendor/bin/phpstan analyse

run_ecs:
	docker-compose exec -T symfony-cqrs-php vendor/bin/ecs check src/ --fix

build_test:
	docker-compose -f docker-compose-test-mac.yaml build

start_test:
	docker volume create --name=symfony-cqrs-api-app-sync
	docker-compose -f docker-compose-test.yaml up -d
	docker-sync start -f

stop_test:
	docker-compose -f docker-compose-test.yaml down
	docker-sync stop

install_test:
	sh ./install-test.sh

execphp_test:
	docker-compose exec symfony-cqrs-php-test bash
