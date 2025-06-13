# Dockerfile
FROM laravelsail/php82-composer

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nodejs \
    npm \
    sqlite3 \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /app

# Copy code
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

COPY . .

# Install Node dependencies & build assets
RUN npm install && npm run build

# Generate key
RUN php artisan key:generate

# Cache configs
RUN php artisan config:cache && php artisan view:cache && php artisan route:cache

# Create SQLite file if not exists
RUN touch database/database.sqlite

# Expose port for Laravel app
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
