FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk update && apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite \
    sqlite-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd pdo_sqlite zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm install
RUN npm run build

# Create SQLite database file and set permissions
RUN touch database/database.sqlite && \
    chmod 777 database/database.sqlite

# Set file permissions for storage and bootstrap cache
RUN chmod -R 777 storage bootstrap/cache

# Clear cache
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear

# Expose port 9000 for FPM
EXPOSE 9000

# Set the user to www-data
USER www-data

# Start PHP-FPM server
CMD ["php-fpm"]