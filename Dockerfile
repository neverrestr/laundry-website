```dockerfile
FROM serversideup/php:8.4-fpm-nginx

# Копируем файлы проекта
COPY . /var/www/html

# Копируем скрипт запуска сразу с правами на выполнение
COPY --chmod=755 scripts/00-laravel-deploy.sh /etc/entrypoint.d/00-laravel-deploy.sh

# Даем права на папки, куда Laravel будет писать
USER root
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
USER www-data
```