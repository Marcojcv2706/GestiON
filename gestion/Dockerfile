# PROYECTO/GestiON/Dockerfile

# --- Etapa de Build ---
# Usamos una imagen con PHP 8.2 (ajusta la versión si es necesario) y Composer
FROM composer:2.5 as vendor

WORKDIR /app
# Copiamos solo los archivos de dependencias e instalamos
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-scripts --prefer-dist

# --- Etapa de Aplicación ---
# Usamos la imagen oficial de PHP-FPM
FROM php:8.2-fpm-alpine

# Argumentos para el usuario
ARG APP_USER=www-data
ARG APP_GROUP=www-data
ARG APP_UID=82
ARG APP_GID=82

# Instalar extensiones de PHP necesarias para Laravel
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    jpeg-dev \
    freetype-dev \
    oniguruma-dev \
    libzip-dev \
    supervisor \
    nginx

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    zip

# Crear el grupo y usuario de la aplicación
RUN addgroup -g ${APP_GID} ${APP_GROUP} && \
    adduser -u ${APP_UID} -G ${APP_GROUP} -s /bin/sh -D ${APP_USER}

WORKDIR /var/www/html

# Copiar dependencias de la etapa 'vendor'
COPY --from=vendor /app/vendor/ /var/www/html/vendor/

# Copiar el resto del código de la aplicación
COPY . .

# Ajustar permisos
RUN chown -R ${APP_USER}:${APP_GROUP} /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Limpiar cache
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Exponer el puerto de PHP-FPM
EXPOSE 9000

# El comando se ejecutará a través de un script de entrada
CMD ["php-fpm"]