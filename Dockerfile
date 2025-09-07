FROM php:8.2-fpm-alpine

WORKDIR /var/www

# =====================================================
# Install system dependencies
# =====================================================
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

# =====================================================
# Install PHP extensions
# =====================================================
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ && \
    docker-php-ext-install pdo_mysql mbstring zip intl bcmath opcache gd

# =====================================================
# Install Composer
# =====================================================
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# =====================================================
# Copy project source
# =====================================================
COPY ./web /var/www

# =====================================================
# Install backend dependencies
# =====================================================
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts

# =====================================================
# Install frontend dependencies & build Vite
# =====================================================
RUN npm install && npm run build

# =====================================================
# Setup permission folder
# =====================================================
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# =====================================================
# Copy Nginx and supervisord configs
# =====================================================
COPY ./nginx/default.conf /etc/nginx/http.d/default.conf
COPY ./supervisord.conf /etc/supervisord.conf

# =====================================================
# Entrypoint
# =====================================================
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
