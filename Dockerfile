FROM php:8.2-cli

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

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000