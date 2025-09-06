# Base image
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk add --no-cache \
    bash \
    nginx \
    supervisor \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    bash \
    curl \
    git \
    openssl \
    shadow \
    sudo

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip intl bcmath opcache 

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Add non-root user
RUN adduser -D -g '' mona
USER mona

# Copy application code
COPY --chown=mona:mona ./web .

# Setup nginx and supervisord configs
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./supervisord.conf /etc/supervisord.conf

# Expose port
EXPOSE 80

# Entrypoint
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
