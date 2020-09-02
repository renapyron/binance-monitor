#!/usr/bin/env sh
set -e

# chown www-data -R /var/www/storage
echo "proj root" ${PROJECT_ROOT}
exec php-fpm
