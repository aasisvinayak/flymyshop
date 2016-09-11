#!/bin/sh
cd /var/www/html

if [ -z "$APP_KEY" ]
then
  echo "Please re-run  with variable \$APP_KEY"
  php artisan key:generate --show
  php artisan migrate
  php artisan db:seed --no-interaction --class=UsersTableSeeder
  php artisan db:seed --no-interaction --class=UserTypesTableSeeder
  php artisan db:seed --no-interaction --class=CategoriesTableSeeder
  php artisan db:seed --no-interaction --class=ProductsTableSeeder
  exit
fi
