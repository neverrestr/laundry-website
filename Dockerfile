FROM serversideup/php:8.4-fpm-nginx

USER root
COPY . /var/www/html
COPY --chmod=755 scripts/00-laravel-deploy.sh /etc/entrypoint.d/00-laravel-deploy.sh
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
USER www-data

# Ключевое изменение: сообщаем NGINX слушать порт, который передаёт Render
CMD ["sh", "-c", "export NGINX_PORT=$PORT && /init"]