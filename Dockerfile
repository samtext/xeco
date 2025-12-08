FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy entire Laravel app
COPY . /var/www

# Copy .env.example to .env
RUN cp .env.example .env

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Cache configs and generate key
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 9000

CMD ["php-fpm"]
