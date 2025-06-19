FROM php:8.2-apache
LABEL maintainer="tu_email@dominio.com"

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html/discos/

RUN chown -R www-data:www-data /var/www/html/discos

EXPOSE 80





