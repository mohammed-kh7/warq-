FROM php:8.2-cli
RUN apt-get update && apt-get install -y git unzip libzip-dev && docker-php-ext-install zip pdo pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 777 storage bootstrap/cache
CMD php -S 0.0.0.0:$PORT -t public