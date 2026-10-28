FROM serversideup/php:8.4-fpm-nginx

# Копируем файлы проекта
COPY . /var/www/html

# Копируем скрипт запуска с правами на выполнение
COPY --chmod=755 scripts/00-laravel-deploy.sh /etc/entrypoint.d/00-laravel-deploy.sh

# Настраиваем права для Laravel
USER root
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
USER www-data