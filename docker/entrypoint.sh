#!/bin/bash
set -e

# Install PHP dependencies
if [ ! -f "vendor/autoload.php" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction
fi

# Install and build frontend assets
if [ ! -d "public/build" ]; then
    echo "Installing NPM dependencies and building assets..."
    npm install
    npm run build
fi

# Create .env if it doesn't exist
if [ ! -f ".env" ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
fi

# Generate app key if not set
if grep -q "^APP_KEY=$" .env; then
    echo "Generating app key..."
    php artisan key:generate
fi

# Wait for MySQL to be ready
echo "Waiting for MySQL..."
while ! php -r "try { new PDO('mysql:host=${DB_HOST};port=${DB_PORT}', '${DB_USERNAME}', '${DB_PASSWORD}'); echo 'ok'; } catch(Exception \$e) { exit(1); }" 2>/dev/null; do
    sleep 2
done
echo "MySQL is ready!"

# Run migrations and seed
php artisan migrate --force --seed 2>/dev/null || php artisan migrate --force

echo "Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=8000
