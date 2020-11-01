FROM php:7.3.2-apache-stretch

LABEL maintainer="Douglas Magno <domagn2@gmail.com>" \
      version="1.0"

COPY --chown=www-data:www-data . /srv/app

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/app

RUN docker-php-ext-install mbstring pdo pdo_mysql \
    && a2enmod rewrite negotiation \
    && docker-php-ext-install opcache
