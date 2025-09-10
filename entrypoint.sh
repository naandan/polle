#!/bin/bash
set -e

php artisan migrate --force

echo "Membersihkan cache lama..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan optimize:clear

echo "Optimisasi Laravel..."
php artisan optimize
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan livewire:publish --assets
php artisan filament:optimize
php artisan sitemap:generate

echo "Menjalankan Nginx + PHP-FPM via supervisord..."
exec supervisord -c /etc/supervisord.conf
