# Use official PHP image with Apache
FROM php:8.2-apache

# Install dependencies
# RUN apt-get update && apt-get install -y \
#     git \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     unzip \
#     sqlite3 \
#     libsqlite3-dev \
#     && docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# # Install Node.js
# RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
# RUN apt-get install -y nodejs

# # Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # Set working directory
# WORKDIR /var/www/html

# # Copy existing application directory contents
# COPY . .

# # Install PHP dependencies
# RUN composer install --optimize-autoloader --no-dev

# # Install npm dependencies and build assets
# RUN npm install && npm run prod

# # Set permissions
# RUN chown -R www-data:www-data /var/www/html/storage
# RUN chown -R www-data:www-data /var/www/html/bootstrap/cache
# RUN chmod -R 775 /var/www/html/storage
# RUN chmod -R 775 /var/www/html/bootstrap/cache

# # Enable Apache mod_rewrite
# RUN a2enmod rewrite

# # Copy custom Apache config
# COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# # Expose port 80
# EXPOSE 80

# # Start Apache
CMD ["apache2-foreground"]