FROM php:8.2-fpm-alpine
RUN apk add --no-cache nginx zip unzip libzip-dev curl libpq-dev \
  && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction
COPY . .
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
  && chmod -R 775 /app/storage /app/bootstrap/cache
COPY docker/nginx.conf /etc/nginx/nginx.conf
EXPOSE 10000
CMD sh -c "php artisan migrate --force; php-fpm -D && nginx -g 'daemon off;'"