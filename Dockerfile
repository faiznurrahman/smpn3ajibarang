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

# 🔥 COPY ENV BIAR LARAVEL NGGAK ERROR
RUN cp .env.example .env || true

# 🔥 FIX STORAGE
RUN mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

# 🔥 INSTALL TANPA SCRIPT (INI KUNCI)
RUN composer install --no-interaction --optimize-autoloader --no-scripts

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000