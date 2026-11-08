FROM serversideup/php:8.4-fpm-nginx

# Копируем файлы проекта
COPY . /var/www/html

# Копируем наш скрипт запуска в специальную папку образа
COPY scripts/00-laravel-deploy.sh /etc/entrypoint.d/00-laravel-deploy.sh

# Делаем скрипт исполняемым
RUN chmod +x /etc/entrypoint.d/00-laravel-deploy.sh

# Даем права на папки, куда Laravel будет писать
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database