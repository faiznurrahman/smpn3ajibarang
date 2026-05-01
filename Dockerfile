FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libicu-dev git curl libpng-dev libonig-dev \
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

RUN printf '#!/bin/bash\nset -e\necho "Clearing config..."\nphp artisan config:clear\necho "Installing migration table..."\nphp artisan migrate:install || true\necho "Running migrations..."\nphp artisan migrate --force\necho "Starting server..."\nexec php artisan serve --host=0.0.0.0 --port=8000\n' > /app/start.sh \
    && chmod +x /app/start.sh \
    && cat /app/start.sh

EXPOSE 8000

CMD ["/bin/bash", "/app/start.sh"]