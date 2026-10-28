```bash
#!/usr/bin/env bash

set -Eeuo pipefail

cd /var/www/html

echo "=========================================="
echo "Starting Laravel deployment"
echo "=========================================="

# 1. Check required files
echo "1. Checking project files"

if [ ! -f artisan ]; then
    echo "ERROR: Laravel artisan file not found in /var/www/html"
    exit 1
fi

if [ ! -f composer.json ]; then
    echo "ERROR: composer.json not found"
    exit 1
fi

# 2. Install Composer dependencies
echo "2. Installing Composer dependencies"

composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --optimize-autoloader

echo "Composer dependencies installed successfully"

# 3. Prepare environment
echo "3. Setting up environment"

if [ ! -f .env ]; then
    cp .env.example .env
fi

# Use SQLite for this deployment
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env

# Use an absolute path for the SQLite database
if grep -q '^DB_DATABASE=' .env; then
    sed -i 's|^DB_DATABASE=.*|DB_DATABASE=/var/www/html/database/database.sqlite|' .env
else
    echo 'DB_DATABASE=/var/www/html/database/database.sqlite' >> .env
fi

# 4. Prepare SQLite database
echo "4. Preparing SQLite database"

mkdir -p database
touch database/database.sqlite

# 5. Generate application key only if one is not configured
echo "5. Checking application key"

if ! grep -q '^APP_KEY=base64:' .env; then
    php artisan key:generate --force
fi

# 6. Run database migrations
echo "6. Running database migrations"

php artisan migrate --force

# 7. Clear stale cached configuration
echo "7. Clearing old caches"

php artisan optimize:clear

# 8. Rebuild production caches
echo "8. Building production caches"

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=========================================="
echo "Laravel deployment initialization completed"
echo "=========================================="
```