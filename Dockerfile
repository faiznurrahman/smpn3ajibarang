FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libicu-dev git curl \
    && docker-php-ext-install zip intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN cp .env.example .env || true

# 🔥 FIX STORAGE
RUN mkdir -p storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

# 🔥 FIX CACHE PATH
ENV VIEW_COMPILED_PATH=/app/storage/framework/views

RUN composer install --no-interaction --optimize-autoloader --no-scripts

EXPOSE 8000

CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000