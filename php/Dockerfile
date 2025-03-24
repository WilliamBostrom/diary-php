FROM php:8.1-apache

# Installera PDO MySQL-tillägget
RUN docker-php-ext-install pdo pdo_mysql

# Aktivera Apache rewrite module
RUN a2enmod rewrite 

