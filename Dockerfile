# Dockerfile
FROM laravelsail/php82-composer

# # Install system dependencies (SQLite, Node.js, npm, etc.)
# RUN apt-get update && apt-get install -y \
#     sqlite3 libsqlite3-dev \
#     nodejs npm unzip git curl

# # Set working directory
# WORKDIR /app

# # Copy project files
# COPY . .

# # Install PHP dependencies
# RUN composer install --no-dev --optimize-autoloader --no-interaction

# # Install Node modules (for Vue frontend)
# RUN npm install && npm run build

# # Set Laravel permissions
# RUN chmod -R 775 storage bootstrap/cache

# # Copy .env file ကို ကူးပါ
# COPY .env .env

# # Set permissions
# RUN chmod 777 .env

# # Generate key
# RUN php artisan key:generate

# FROM php:8.2-apache-alpine

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite3 libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Install Composer (redundant if already in base image, but safe)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy .env file
COPY .env .env

# Generate key
RUN php artisan key:generate

# Set file permissions for storage and bootstrap cache
RUN chmod -R 777 storage bootstrap/cache

# Create SQLite db file
RUN touch database/database.sqlite

# Clear cache
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear

# Expose port 80
EXPOSE 80

# Set the user to www-data
USER www-data

# Start Apache server
CMD ["apache2-foreground"]
