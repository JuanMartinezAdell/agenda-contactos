# Definir la imagen base
FROM php:8.1.9-fpm-alpine

# Actualizar e instalar dependencias necesarias
RUN apk --no-cache upgrade && \
    apk --no-cache add bash git sudo openssh libxml2-dev oniguruma-dev autoconf gcc g++ make npm freetype-dev libjpeg-turbo-dev libpng-dev libzip-dev

# Instalar extensiones de PHP y habilitarlas
RUN pecl channel-update pecl.php.net && \
    pecl install pcov ssh2 swoole && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install mbstring xml pcntl gd zip sockets pdo pdo_mysql bcmath soap && \
    docker-php-ext-enable mbstring xml gd zip pcov pcntl sockets bcmath pdo pdo_mysql soap swoole

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer​ | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar RoadRunner
COPY --from=spiralscout/roadrunner:2.4.2 /usr/bin/rr /usr/bin/rr

# Configurar el directorio de trabajo
WORKDIR /app

# Copiar archivos de la aplicación
COPY . .

# Instalar dependencias de PHP y Node.js
RUN composer install --no-interaction --no-ansi --no-scripts --no-progress --prefer-dist && \
    composer require laravel/octane spiral/roadrunner && \
    npm install --global yarn && \
    yarn && \
    yarn prod && \
    chown -R www-data:www-data /app

# Generar la clave de la aplicación y migrar la base de datos
RUN php artisan key:generate && \
    php artisan migrate --force

# Instalar Octane y configurar Swoole
RUN php artisan octane:install --server="swoole"

# Exponer el puerto de Octane
EXPOSE 8000

# Ejecutar el servidor Octane
CMD ["php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0"]


