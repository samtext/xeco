# Use the official PHP image with necessary extensions
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    curl \
    && docker-php-ext-install pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy composer and install dependencies
COPY composer.lock composer.json ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the application
COPY . .

# Generate Laravel key
RUN php artisan key:generate

# Expose port and run Laravel server
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
