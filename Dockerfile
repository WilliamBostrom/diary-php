FROM php:8.2-apache

# Installera PDO MySQL-drivrutinen
RUN docker-php-ext-install pdo pdo_mysql

# Aktivera moduler
RUN a2enmod rewrite
