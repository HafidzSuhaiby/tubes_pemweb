# === Base image PHP sesuai requirement (^8.2) ===
FROM php:8.2-fpm

# Install package yang dibutuhkan PHP & Node (buat Vite build)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    nodejs \
    npm \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set direktori kerja di dalam container
WORKDIR /var/www

# Copy file composer dulu untuk cache layer
COPY composer.json composer.lock* ./

# Install dependency PHP tanpa menjalankan script composer
# (penting karena di composer.json kamu ada script yang pakai artisan & migrate)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy semua isi project
COPY . .

# Install dependency JS & build asset Vite (kalau ada)
# Kalau npm gagal (misalnya kamu nggak pakai Vite), build tetap lanjut
RUN npm install && npm run build || echo "npm build skipped"

# Permission untuk storage & cache
RUN chmod -R 775 storage bootstrap/cache

# Port yang akan digunakan Railway ($PORT akan diisi otomatis di server)
EXPOSE 8000

# Jalankan server Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
