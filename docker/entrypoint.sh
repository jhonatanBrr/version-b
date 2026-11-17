#!/bin/sh
set -e

# No database and no secrets beyond APP_KEY. If the host does not provide one,
# generate an ephemeral key so the demo boots anyway (sessions reset on restart).
if [ -z "$APP_KEY" ]; then
    APP_KEY="$(php artisan key:generate --show --no-interaction)"
    export APP_KEY
    echo "APP_KEY not set: generated an ephemeral key for this container."
fi

# Cache configuration, routes and views for production.
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

exec "$@"
