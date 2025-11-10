#!/bin/bash

# Exit immediately if a command fails
set -e

# Go to the repository directory
cd /home/nidccglo/mypow.app || exit

echo "Pulling latest changes from main..."
git pull origin main

echo "Installing dependencies..."
/opt/cpanel/ea-php84/root/usr/bin/php -d allow_url_fopen=On composer.phar install --no-dev --optimize-autoloader

echo "Running Laravel optimizations..."
/opt/cpanel/ea-php84/root/usr/bin/php artisan migrate --force
/opt/cpanel/ea-php84/root/usr/bin/php artisan optimize:clear
/opt/cpanel/ea-php84/root/usr/bin/php artisan view:clear
/opt/cpanel/ea-php84/root/usr/bin/php artisan config:clear
/opt/cpanel/ea-php84/root/usr/bin/php artisan route:clear
/opt/cpanel/ea-php84/root/usr/bin/php artisan cache:clear

echo "⚙e-optimizing..."
/opt/cpanel/ea-php84/root/usr/bin/php artisan config:cache
/opt/cpanel/ea-php84/root/usr/bin/php artisan route:cache
/opt/cpanel/ea-php84/root/usr/bin/php artisan view:cache

echo "Deployment completed successfully!"
