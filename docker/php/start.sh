#!/bin/bash

# Wait for database to be ready
echo "Waiting for database..."
while ! nc -z db 3306; do
  sleep 1
done

echo "Database is ready!"

# Run composer scripts that were skipped during build
echo "Running post-autoload scripts..."
composer run-script post-autoload-dump

# Run Laravel setup commands
echo "Generating application key..."
php artisan key:generate --force

echo "Running migrations..."
php artisan migrate --force

echo "Setup complete!"

# Start PHP-FPM
exec php-fpm
