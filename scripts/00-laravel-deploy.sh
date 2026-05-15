#!/usr/bin/env bash
set -e

echo "Running composer install..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

echo "Publishing Cloudinary config..."
php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" --force || true

echo "Clearing cache..."
php artisan config:clear
php artisan cache:clear

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

echo "Creating queue jobs table..."
php artisan queue:table || true
php artisan migrate --force

echo "Done!"
