FROM php:8.2-fpm

# Ensure apt is in non-interactive mode
ARG DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    build-essential \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

#npm
RUN npm install --legacy-peer-deps && npm run build

# Laravel optimization & permissions
RUN php artisan storage:link \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan optimize \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan migrate:fresh

# # Set permissions (optional but recommended)
# RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port
EXPOSE 8080

# Start Laravel using PHP's built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]