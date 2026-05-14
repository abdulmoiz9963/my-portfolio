#!/usr/bin/env bash
set -e

echo "Running composer install..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

echo "Publishing Cloudinary config..."
php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" --force || true

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Creating storage symlink..."
php artisan storage:link

echo "Seeding admin user..."
php artisan db:seed --force

echo "Done!"
