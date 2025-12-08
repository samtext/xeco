# Use an official PHP image with FPM
FROM php:8.1-fpm

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy composer.lock and composer.json
COPY composer.json composer.lock /var/www/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the application files
COPY . /var/www

# Expose the port the app runs on
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
