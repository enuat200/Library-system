# Use an official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (essential for MVC routing)
RUN a2enmod rewrite

# Install MySQL extensions required by the app
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli pdo_mysql

# Copy your project files into the container's web directory
COPY . /var/www/html/

# Set correct permissions for Apache
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80