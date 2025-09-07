# Base image PHP
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install system dependencies
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
    libjpeg-turbo-dev \
    nodejs \
    npm

# Configure GD
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip intl bcmath opcache gd

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY ./web /var/www

# Pastikan folder storage dan bootstrap/cache writable
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Install dependencies frontend & build Vite
RUN npm install --prefix /var/www
RUN npm run build --prefix /var/www

# Copy Nginx and supervisord configs
COPY ./nginx/default.conf /etc/nginx/http.d/default.conf
COPY ./supervisord.conf /etc/supervisord.conf

# Copy entrypoint
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
