FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    build-essential \
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

# Set permissions (optional but recommended)
RUN chown -R www-data:www-data storage bootstrap/cache
