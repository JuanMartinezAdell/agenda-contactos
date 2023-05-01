# Imagen base de PHP
FROM php:8.0-fpm

# Copiar el archivo de configuración de PHP
COPY ./docker/php/php.ini /usr/local/etc/php/

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo_mysql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar Node.js y NPM
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# Instalar Nginx
RUN apt-get update && apt-get install -y nginx

# Copiar la configuración de Nginx
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default

# Crear directorio para la aplicación
WORKDIR /var/www/html

# Copiar archivos de la aplicación al contenedor
COPY . .

# Instalar dependencias de Composer y de NPM
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run production

# Exponer puerto de Nginx
EXPOSE 80

# Ejecutar Nginx y PHP-FPM
CMD service nginx start && php-fpm

