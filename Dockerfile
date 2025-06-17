# Base PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (important for Laravel routes)
RUN a2enmod rewrite

# Set working directory
WORKDIR /public

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    sqlite3 \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip mbstring xml

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Give correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy Laravel .env.production as .env (Render uses production environment)
RUN if [ -f .env.production ]; then cp .env.production .env; fi

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel commands for production setup
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Default Apache command will run and serve Laravel
