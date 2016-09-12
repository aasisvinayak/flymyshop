#!/bin/sh
cd /var/www/html
service apache2 start
php artisan queue:listen