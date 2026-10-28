#!/usr/bin/env bash

echo "1. Installing Composer dependencies"
composer install --no-dev --ignore-platform-reqs --working-dir=/var/www/html

echo "2. Setting up .env file"
cp .env.example .env
sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/g' .env

echo "3. Generating app key"
php artisan key:generate --force

echo "4. Creating SQLite database"
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 777 /var/www/html/database/database.sqlite

echo "5. Running migrations"
php artisan migrate --force

echo "6. Caching config and routes"
php artisan config:cache
php artisan route:cache

echo "7. Final permissions"
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/public