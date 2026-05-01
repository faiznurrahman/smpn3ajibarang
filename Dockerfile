FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libicu-dev \
    git \
    curl \
    && docker-php-ext-install zip intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# 🔥 penting
ENV COMPOSER_ALLOW_SUPERUSER=1

# 🔥 FIX STORAGE
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000