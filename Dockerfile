FROM php:8.4-apache

WORKDIR /var/www/html

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Instala dependências e extensões
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip exif gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia os arquivos do projeto
COPY . .

# Permissões (ajuste conforme necessário)
RUN chown -R www-data:www-data /var/www/html