# symfony-contacts

## Run with Docker

```console
$ git clone git@github.com:mhz-tamb/symfony-contacts.git
$ cd symfony-contacts

$ docker-compose up -d

# Migrations
$ docker-compose exec app php bin/console doctrine:migration:migrate -n

# Fixtures
$ docker-compose exec app php bin/console doctrine:fixtures:load -n
```
