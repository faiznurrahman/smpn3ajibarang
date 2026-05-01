FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libicu-dev git curl libpng-dev libonig-dev nodejs npm \
    && docker-php-ext-install zip intl pdo pdo_mysql mbstring

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN rm -f .env

RUN mkdir -p storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

ENV VIEW_COMPILED_PATH=/app/storage/framework/views

RUN composer install --no-interaction --optimize-autoloader --no-scripts

RUN npm install && npm run build

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
