#!/bin/sh
cd /var/www/html
  php artisan key:generate
  php artisan migrate