#!/bin/bash
set -e

echo "Clearing config..."
php artisan config:clear

echo "Installing migration table..."
php artisan migrate:install || true

echo "Running migrations..."
php artisan migrate --force

echo "Starting server..."
exec php artisan serve --host=0.0.0.0 --port=8000