# Base image with PHP and Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    sqlite3 \
    libsqlite3-dev \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite zip mbstring xml

# Set working directory to Laravel root
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy all files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node modules and build frontend
RUN npm install && npm run build

# Create SQLite database file
RUN mkdir -p database && touch database/database.sqlite

# Set file permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Use production .env if available
RUN if [ -f .env.production ]; then cp .env.production .env; fi

# Laravel cache
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Update Apache to serve from public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Expose Apache port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
