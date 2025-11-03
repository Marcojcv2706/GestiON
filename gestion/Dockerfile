# Etapa 1: PHP-FPM con extensiones
FROM php:8.2-fpm

# Instalar dependencias del sistema
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

# Instalar dependencias de Laravel (sin dev)
RUN composer install --no-dev --optimize-autoloader

# Ajustar permisos de almacenamiento y cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public

# Exponer el puerto de PHP-FPM (por defecto 9000)
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]
