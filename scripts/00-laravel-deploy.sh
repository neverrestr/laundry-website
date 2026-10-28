#!/usr/bin/env bash
echo "1. Setting up .env file"
cp .env.example .env
sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/g' .env

echo "2. Generating app key"
php artisan key:generate --force

echo "3. Creating SQLite database and setting permissions"
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 777 /var/www/html/database/database.sqlite

echo "4. Installing Composer dependencies"
composer install --no-dev --working-dir=/var/www/html

echo "5. Running migrations"
php artisan migrate --force

echo "6. Caching config and routes"
php artisan config:cache
php artisan route:cache

echo "7. Final permissions"
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache