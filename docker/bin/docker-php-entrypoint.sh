#!/usr/bin/env sh
set -e

# always run migrations on startup
# TODO proper mysql connection checker every 1 sec instead of waiting fixed time
sleep 15
php artisan migrate

exec php-fpm
