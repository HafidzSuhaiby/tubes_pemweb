FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    nodejs npm \
    libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set work directory
WORKDIR /var/www

# Copy composer first for cache
COPY composer.json composer.lock* ./

# Install PHP dependencies without running scripts
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy the rest of the project
COPY . .

# Build Vite (optional, skip if error)
RUN npm install && npm run build || echo "Skipping npm build"

# Storage permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Run Laravel server
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
