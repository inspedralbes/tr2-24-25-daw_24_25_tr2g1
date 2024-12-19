FROM php:8.2-fpm

#Preparem la imatge amb tot lo necessari per treballar amb php

RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev
RUN apt clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# De la imatge oficial de composer agafem el binari i el posem a /usr/bin/composer
# d'aquest forma aconseguim una imatge amb php i composer i la podrem
# utilitzar per la nostra aplicació laravel

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer