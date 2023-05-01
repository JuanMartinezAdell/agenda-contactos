# Dockerfile

# Usa la imagen oficial de PHP 8.0
FROM php:8.0-fpm

# Instala dependencias de sistema necesarias
RUN apt-get update && \
    apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install \
    pdo_mysql \
    bcmath \
    intl \
    mbstring \
    zip \
    exif \
    pcntl \
    gd

# Configura la extensión gd
RUN docker-php-ext-configure \
    gd --with-freetype --with-jpeg

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo en /var/www
WORKDIR /var/www

# Copia el archivo composer.json y el archivo composer.lock al contenedor
COPY composer.json composer.lock /var/www/

# Ejecuta composer install para instalar las dependencias de Laravel
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-suggest

# Copia todo el contenido de la aplicación al contenedor
COPY . /var/www

# Crea el archivo .env
RUN cp .env.example .env

# Genera la clave de la aplicación
RUN php artisan key:generate

# Expone el puerto 9000 para que Nginx pueda acceder al servidor PHP-FPM
EXPOSE 9000

# Ejecuta el servidor PHP-FPM
CMD ["php-fpm"]
