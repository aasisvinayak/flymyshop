#!/bin/sh
cd /var/www/html
php artisan serve --port=80 &
php artisan queue:listen