FROM serversideup/php:8.4-fpm-nginx

USER root

# Устанавливаем Node.js и npm (стандартный способ для Debian-образов)
RUN apt-get update && apt-get install -y curl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Копируем проект
COPY . /var/www/html

# Устанавливаем PHP-зависимости и собираем фронтенд
RUN composer install --no-dev --no-interaction --optimize-autoloader
RUN npm install
RUN npm run build

# Готовим .env и базу SQLite
RUN cp .env.example .env || true \
    && sed -i 's/^APP_ENV=.*/APP_ENV=production/' .env \
    && sed -i 's/^APP_DEBUG=.*/APP_DEBUG=false/' .env \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

USER www-data