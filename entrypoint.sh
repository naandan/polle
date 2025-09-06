#!/bin/bash
set -e

# Jalankan migrasi & seeding jika perlu
# Perintah wajib untuk production Laravel
echo "Menjalankan perintah Laravel production..."

# Generate cache konfigurasi
php artisan config:cache

# Generate cache route
php artisan route:cache

# Generate cache view
php artisan view:cache

# Jalankan migrasi dan seeder (opsional, tergantung kebutuhan)
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Menjalankan migrasi database..."
    php artisan migrate --force
    php artisan db:seed --force
fi

# Bisa jalankan perintah tambahan
if [ ! -z "$CUSTOM_COMMAND" ]; then
    echo "Menjalankan custom command: $CUSTOM_COMMAND"
    bash -c "$CUSTOM_COMMAND"
fi

# Start supervisord untuk menjalankan nginx + php-fpm
exec supervisord -c /etc/supervisord.conf
