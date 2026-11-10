 FROM serversideup/php:8.4-fpm-nginx

# Переключаемся на root, чтобы иметь права на копирование и изменение папок
USER root

# Копируем все файлы проекта
COPY . /var/www/html

# Копируем скрипт и СРАЗУ делаем его исполняемым (больше не нужен RUN chmod)
COPY --chmod=755 scripts/00-laravel-deploy.sh /etc/entrypoint.d/00-laravel-deploy.sh

# Даем права пользователю www-data на папки, куда Laravel будет писать
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Возвращаемся к безопасному пользователю
USER www-data