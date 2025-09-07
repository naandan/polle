#!/bin/bash
set -e

# Pastikan folder vendor ada
mkdir -p /var/www/vendor

# Jalankan composer jika vendor kosong
if [ ! -d "/var/www/vendor" ] || [ -z "$(ls -A /var/www/vendor)" ]; then
    echo "Vendor folder tidak ada, menjalankan composer install..."
    composer install --no-dev --optimize-autoloader --working-dir=/var/www
fi

echo "Menjalankan perintah Laravel production..."

# Cache Laravel
php /var/www/artisan config:cache
php /var/www/artisan route:cache
php /var/www/artisan view:cache

# Jalankan migrasi jika diperlukan
if [ "$RUN_MIGRATIONS" = "true" ]; then
    php /var/www/artisan migrate --force
fi

# Jalankan custom command jika ada
if [ ! -z "$CUSTOM_COMMAND" ]; then
    bash -c "$CUSTOM_COMMAND"
fi

# Start supervisord (root) untuk nginx + php-fpm
exec supervisord -c /etc/supervisord.conf
