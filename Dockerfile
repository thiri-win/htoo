# Dockerfile
FROM laravelsail/php82-composer

# Install system dependencies (SQLite, Node.js, npm, etc.)
RUN apt-get update && apt-get install -y \
    sqlite3 libsqlite3-dev \
    nodejs npm unzip git curl

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node modules (for Vue frontend)
RUN npm install && npm run build

# Set Laravel permissions
RUN chmod -R 775 storage bootstrap/cache

# Copy .env file
COPY .env .env

# Set permissions
RUN chmod 777 .env

# Generate key
RUN php artisan key:generate
