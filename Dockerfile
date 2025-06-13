FROM php:8.2.12-apache

COPY scr/ /var/www/html
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80