# Stock Api

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://douglasmagno.github.io/stock-vue/#/product)

This is a simples API example, build with the best practices of patterns codes like MVC (plus with "SR" Services and Repositories), migrations, Observers, custom artisan commands, dependency injection and others.

# Requirements

  - PHP>=7.4.1
  - Mysql>=10.4.14

### Installation
Quick install [PHP and MYSQL](https://www.apachefriends.org/index.html)

Install the dependencies and devDependencies and start the server.

```sh
# go to yours prefer dir
git clone git@github.com:DouglasMagno/stock-api.git
composer install
php artisan key:generate
# custom command
php artisan make:database stock
php artisan serve
```

## Tests

To test api run units and features run:

```sh
php stock-api/vendor/phpunit/phpunit/phpunit --configuration \stock-api\phpunit.xml \stock-api\tests --teamcity
```
## Play
On the folder:
```sh
stock-api/resources/collections/StockApi.postman_collection.json
```
This file has a [Postman](https://www.postman.com/) collection, with her you can run examples of requests and tests.

## Deploy
For now, the api are deployed on:
```sh
http://stockapi-env.eba-jtrmq3hs.us-east-1.elasticbeanstalk.com/api/
```
