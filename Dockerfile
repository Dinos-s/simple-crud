FROM php:8.3.10-apache

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
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia os arquivos do projeto
COPY . .

# Permissões (ajuste conforme necessário)
RUN chown -R www-data:www-data /var/www/html

# Documentar a porta que será exposta
EXPOSE 80

# Comando para executar ao iniciar o container
CMD ["apache2-foreground"]