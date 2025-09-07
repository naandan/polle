#!/bin/bash
set -e

echo "Menjalankan migrasi jika diperlukan..."
if [ "$RUN_MIGRATIONS" = "true" ]; then
    php artisan migrate --force
fi

echo "Menjalankan custom command jika ada..."
if [ ! -z "$CUSTOM_COMMAND" ]; then
    bash -c "$CUSTOM_COMMAND"
fi

# Start supervisord (root) untuk nginx + php-fpm
exec supervisord -c /etc/supervisord.conf
