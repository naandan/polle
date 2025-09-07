# =====================================================
# Stage 1 - Backend dependencies (Composer)
# =====================================================
FROM php:8.2-cli-alpine AS vendor

# Install dependencies untuk ekstensi PHP yang dibutuhkan Composer
RUN apk add --no-cache \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    git \
    curl \
    bash

# Install extensions (intl, gd, zip)
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ && \
    docker-php-ext-install intl gd zip

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY ./web/composer.json ./web/composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts


# =====================================================
# Stage 2 - Frontend build (Node)
# =====================================================
FROM node:20-alpine AS frontend

WORKDIR /app

# Copy package.json untuk npm install
COPY ./web/package.json ./web/package-lock.json* ./web/yarn.lock* ./
RUN npm install

# Copy source code Laravel (resources/css, js, dll)
COPY ./web ./

# Copy vendor dari stage vendor (agar flux.css tersedia)
COPY --from=vendor /app/vendor /app/vendor

# Build assets dengan Vite
RUN npm run build


# =====================================================
# Stage 3 - Final Image (PHP + Nginx + Supervisor)
# =====================================================
FROM php:8.2-fpm-alpine

WORKDIR /var/www

# System dependencies
RUN apk add --no-cache \
    bash \
    nginx \
    supervisor \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    curl \
    git \
    openssl \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev

# Configure PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ && \
    docker-php-ext-install pdo_mysql mbstring zip intl bcmath opcache gd

# Copy vendor dari Stage 1
COPY --from=vendor /app/vendor /var/www/vendor

# Copy built assets dari Stage 2
COPY --from=frontend /app/public/build /var/www/public/build

# Copy seluruh source code (kecuali node_modules, vendor sudah ada)
COPY ./web /var/www

# Pastikan folder storage dan bootstrap/cache writable
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Laravel cache (optimisasi production)
RUN php artisan optimize && \
    php artisan config:cache && \
    php artisan event:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan filament:optimize

# Copy Nginx and supervisord configs
COPY ./nginx/default.conf /etc/nginx/http.d/default.conf
COPY ./supervisord.conf /etc/supervisord.conf

# Copy entrypoint
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
