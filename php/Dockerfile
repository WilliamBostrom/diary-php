FROM php:8.1-apache

# Installera system-beroenden för GD
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && rm -rf /var/lib/apt/lists/*

# Installera PDO MySQL-tillägget och GD-biblioteket
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql gd

# Aktivera Apache rewrite module
RUN a2enmod rewrite 

