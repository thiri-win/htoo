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

# Install Composer (redundant if already in base image, but safe)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy and install PHP deps
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy rest of the app
COPY . .

# Install Node deps & build
RUN npm install && npm run build

# Cache config
RUN php artisan config:cache && php artisan view:cache && php artisan route:cache

# Create SQLite db file
RUN touch database/database.sqlite

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
