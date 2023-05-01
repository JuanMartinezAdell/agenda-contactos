FROM php:8.0-fpm-alpine

WORKDIR /var/www/html

# Instalar dependencias necesarias
RUN apk add --no-cache \
    git \
    curl \
    libpng \
    libjpeg \
    libwebp \
    libzip \
    libpq \
    libxml2 \
    libxslt \
    freetype \
    icu \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    icu-dev \
    postgresql-dev \
    oniguruma-dev \
    openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install opcache \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install xml \
    && docker-php-ext-install xsl \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install sockets \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-progress --no-scripts

# Configurar Octane
RUN php artisan octane:install

# Exponer el puerto 8000 e inicio el servidor
CMD php artisan octane:start --server="swoole" --host="0.0.0.0"
EXPOSE 8000
