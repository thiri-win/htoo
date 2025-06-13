FROM laravelsail/php82-composer

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zip unzip git curl \
    sqlite3 libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite

# Install Node.js (NodeSource version for compatibility)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy and install PHP deps
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Permissions fix
RUN chmod -R 775 storage bootstrap/cache

# Install Node deps & build assets (e.g. TailwindCSS)
RUN npm install && npm run build

# Laravel caching
RUN php artisan config:cache && php artisan view:cache && php artisan route:cache

# Create SQLite database file
RUN touch database/database.sqlite

# Run migrations
RUN php artisan migrate --force

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
