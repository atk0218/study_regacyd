# Dockerfile - Apache with PHP
FROM php:8.2-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
COPY ./src/ /var/www/html/
ADD ./php.ini /usr/local/etc/php/php.ini
EXPOSE 80