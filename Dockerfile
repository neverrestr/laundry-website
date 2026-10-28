FROM serversideup/php:8.4-fpm-nginx

# Copy the application
COPY . /var/www/html

# Copy the deployment script with executable permissions
COPY --chmod=755 scripts/00-laravel-deploy.sh /etc/entrypoint.d/00-laravel-deploy.sh

# Configure application permissions
USER root

RUN chown -R www-data:www-data /var/www/html 
    && chmod -R u+rwX /var/www/html/storage 
    && chmod -R u+rwX /var/www/html/bootstrap/cache 
    && chmod -R u+rwX /var/www/html/database

USER www-data