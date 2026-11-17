# syntax=docker/dockerfile:1

# ---------------------------------------------------------------------------
# 1. Front-end assets: Stylus + jQuery compiled by Laravel Mix
# ---------------------------------------------------------------------------
FROM node:22-alpine AS assets
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund

COPY webpack.mix.js ./
COPY resources ./resources
RUN npm run production

# ---------------------------------------------------------------------------
# 2. PHP dependencies (production only, optimized autoloader)
# ---------------------------------------------------------------------------
FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --no-scripts --no-autoloader --prefer-dist

COPY . .
RUN composer dump-autoload --no-dev --optimize --classmap-authoritative

# ---------------------------------------------------------------------------
# 3. Runtime: PHP 8.5 + Apache serving /public
# ---------------------------------------------------------------------------
FROM php:8.5-apache

# Render injects $PORT (10000 by default); Apache reads it at start-up.
ENV PORT=10000 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN a2enmod rewrite \
    && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
    && a2enconf servername \
    && sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri 's!<Directory /var/www/>!<Directory ${APACHE_DOCUMENT_ROOT}/>!g' /etc/apache2/apache2.conf \
    && sed -ri 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf \
    && sed -ri 's!Listen 80!Listen ${PORT}!g' /etc/apache2/ports.conf \
    && sed -ri 's!<VirtualHost \*:80>!<VirtualHost *:${PORT}>!g' /etc/apache2/sites-available/000-default.conf \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data --from=vendor /app/vendor ./vendor
COPY --chown=www-data:www-data --from=assets /app/public/css ./public/css
COPY --chown=www-data:www-data --from=assets /app/public/js ./public/js
COPY --chown=www-data:www-data --from=assets /app/public/mix-manifest.json ./public/mix-manifest.json

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

ENTRYPOINT ["entrypoint"]
CMD ["apache2-foreground"]
