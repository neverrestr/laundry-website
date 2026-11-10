FROM serversideup/php:8.4-fpm-nginx

USER root

# Копируем проект
COPY . /var/www/html

# Копируем скрипт и сразу исправляем окончания строк на Linux (LF)
COPY scripts/00-laravel-deploy.sh /etc/entrypoint.d/00-laravel-deploy.sh
RUN sed -i 's/\r$//' /etc/entrypoint.d/00-laravel-deploy.sh && \
    chmod 755 /etc/entrypoint.d/00-laravel-deploy.sh

# Права на папки Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

USER www-data

# Запускаем встроенный сервер (NGINX + PHP-FPM) на порту Render
CMD ["sh", "-c", "export NGINX_PORT=$PORT && /init"]