FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia los archivos del proyecto
COPY . /var/www/html

# Define el working directory
WORKDIR /var/www/html

# Da permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Puerto a exponer
EXPOSE 80

# Comando por defecto
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
