# Dockerfile.apache
# Use the official PHP image as the base image
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install additional PHP extensions and Composer
RUN apt-get update && \
    apt-get install -y git unzip && \
    docker-php-ext-install pdo pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the Laravel project into the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Update the Apache configuration to use the public directory as the document root
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel and SQLite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
