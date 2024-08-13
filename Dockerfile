FROM php:8.2-apache
RUN apt update
ENV DEBIAN_FRONTEND noninteractive
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql
WORKDIR /var/www/html
COPY app/. ./
RUN chmod -R 755 ./

