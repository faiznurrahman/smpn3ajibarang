FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libicu-dev git curl \
    && docker-php-ext-install zip intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1

# buat env
RUN cp .env.example .env || true

# fix permission
RUN mkdir -p storage/framework/{views,cache,sessions} \
    && mkdir -p bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

# install dependency (tanpa script biar gak error)
RUN composer install --no-interaction --optimize-autoloader --no-scripts

EXPOSE 8000

CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000