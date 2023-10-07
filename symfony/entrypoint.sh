#!/bin/bash

# enable command logging for better debugging
set -x

# set correct permissions for cache folder
mkdir -p /tmp/symfony
chown -R www-data:www-data /tmp/symfony
setfacl -R -m u:www-data:rwX /tmp/symfony
setfacl -dR -m u:www-data:rwX /tmp/symfony

# install composer dependencies
composer install --prefer-dist --optimize-autoloader

# run database migrations
while : ; do
    bin/console doctrine:migrations:migrate --no-interaction
    [ $? != 0 ] || break
    sleep 5
done

# warmp cache
bin/console cache:warmup

# run primary services
php-fpm &
nginx -g 'daemon off;'
