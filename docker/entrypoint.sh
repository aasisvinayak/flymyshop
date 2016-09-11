#!/bin/sh
cd /var/www/html

if [ -z "$APP_KEY" ]
then
  echo "Please re-run  with variable \$APP_KEY"
  php artisan key:generate --show
  exit
fi
