# Dockerfile para Laravel + PHP-FPM
FROM php:8.2-fpm

# Instalar extensiones de PHP necesarias y utilidades
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring gd xml

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Laravel (sin dev para producción)
RUN composer install --no-dev --optimize-autoloader

# Ajustar permisos de almacenamiento y cache para Nginx
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Exponer puerto PHP-FPM
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]
