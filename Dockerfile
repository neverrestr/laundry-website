FROM serversideup/php:8.4-fpm-nginx

USER root

# Копируем код
COPY . /var/www/html

# Устанавливаем зависимости PHP и собираем фронтенд
RUN composer install --no-dev --no-interaction --optimize-autoloader
RUN npm ci
RUN npm run build

# Создаём .env, если его нет, и заполняем базовые переменные
RUN cp .env.example .env || true && \
    sed -i 's/^APP_ENV=.*/APP_ENV=production/' .env && \
    sed -i 's/^APP_DEBUG=.*/APP_DEBUG=false/' .env

# Создаём файл базы SQLite и даём права
RUN touch /var/www/html/database/database.sqlite && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

USER www-data