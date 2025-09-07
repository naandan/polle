#!/bin/bash
set -e

echo "Membersihkan cache lama..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Optimisasi Laravel..."
php artisan optimize
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan livewire:publish --assets
php artisan filament:optimize

echo "Menjalankan migrasi jika diperlukan..."
if [ "$RUN_MIGRATIONS" = "true" ]; then
    php artisan migrate --force
fi

echo "Menjalankan custom command jika ada..."
if [ ! -z "$CUSTOM_COMMAND" ]; then
    bash -c "$CUSTOM_COMMAND"
fi

echo "Menjalankan Nginx + PHP-FPM via supervisord..."
exec supervisord -c /etc/supervisord.conf
