# Example Symfony CRUD DDD hexagonal architecture app

## Local usage

The Symfony web app runs on [http://localhost:8080](http://localhost:8080).

### Requirements

- Linux, preferably Ubuntu or Debian
  - other linus distros and operating systems (such as Windows od Mac OS) are not tested
  - php docker image might not run as expected on ARM CPUs (such as new Macbooks and Macs), the images are not tested on ARM
- [Docker & docker compose](https://docs.docker.com/engine/install/)

### First startup

Copy `docker-compose.override.example.yml` into `docker-compose.override.yml`.

```bash
# start containers and watch the logs until:
# - mysql container imports the database dump and you will see "ready for connections" in the mysql container logs
# - php container installs composer dependencies, successfully connects to mysql container and executes database migrations
# - once the above is done, you will see "fpm is running" and "ready to handle connections" in the php container logs
#
# if something does not seem right with the first startup, please see container logs and/or contact maintainer of this repository
docker compose up
```

### Normal usage

```bash
# to start container
docker compose up -d

# install composer dependencies
docker compose exec symfony bash -c 'XDEBUG_MODE=off composer install --prefer-dist --optimize-autoloader'

# make & execute pending database migrations
docker compose exec symfony bin/console make:migration
docker compose exec symfony bin/console doctrine:migrations:migrate --no-interaction --all-or-nothing
# rollback last transaction
docker compose exec symfony bin/console doctrine:migrations:migrate --no-interaction prev

# connect to mysql
docker compose exec mysql mysql -usymfony -pzTL32UkUGpoX --default-character-set=utf8mb4 symfony
# create sql dump
docker compose exec mysql mysqldump -uroot -pzTL32UkUGpoX --default-character-set=utf8mb4 symfony > ./mysql/init/1_symfony.sql

# reset database
docker compose exec symfony bin/console doctrine:database:drop --force
docker compose exec symfony bin/console doctrine:database:create
docker compose exec symfony bin/console doctrine:migrations:migrate --no-interaction --all-or-nothing
# the fixtures might take a while to finish
docker compose exec symfony bin/console doctrine:fixtures:load --no-interaction
```

### Tests

#### Reset database, SQL connection & dump

```bash
# reset database
docker compose exec symfony bin/console doctrine:database:drop --force --env=test
docker compose exec symfony bin/console doctrine:database:create --env=test
docker compose exec symfony bin/console doctrine:migrations:migrate --no-interaction --env=test --all-or-nothing
# the fixtures might take a while to finish
docker compose exec symfony bin/console doctrine:fixtures:load --no-interaction --env=test

# connect to mysql
docker compose exec mysql mysql -usymfony -pzTL32UkUGpoX --default-character-set=utf8mb4 symfony_test
# create sql dump
docker compose exec mysql mysqldump -uroot -pzTL32UkUGpoX --default-character-set=utf8mb4 symfony_test > ./mysql/init/3_symfony_test.sql
```

#### Unit tests

```bash
docker compose exec symfony php vendor/bin/codecept run unit
```

#### Functional tests

```bash
docker compose exec symfony php vendor/bin/codecept run functional
```

#### Acceptance tests

If you would like to run acceptance test, uncomment `firefox` container in your docker-compose.override.yml.
To run acceptance tests, you need to have firefox instance running. It can be resource heavy, so it is commented out by default.

```bash
docker compose exec symfony php vendor/bin/codecept run acceptance
```

## Sources of inspiration

- https://minompi.medium.com/symfony-and-hexagonal-architecture-b3c4704e94de
- https://herbertograca.com/2017/11/16/explicit-architecture-01-ddd-hexagonal-onion-clean-cqrs-how-i-put-it-all-together/
- https://dev.to/victoor/ddd-and-hexagonal-architecture-with-symfony-flex-part-2-4ojc
- https://riekeltbrands.medium.com/symfony-how-to-effectively-use-tagged-services-2bf6e0b11bb9

## TODO

- resolve TODOs in the code
- translations
- add architecture diagram
- add code dependency graph visualisation to point out potential problems
- add README to certain directories for better understanding of the architecture
- add static code analysis, linter
- check if there are strict_types everywhere and if we still need to declare it everywhere
- handle exceptions in controllers
- add test coverage report, maybe also badge
- pre-commit hooks to run tests