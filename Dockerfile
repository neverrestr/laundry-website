FROM serversideup/php:8.4-fpm-nginx
USER root
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
USER www-data