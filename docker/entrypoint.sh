#!/bin/sh
cd /var/www/html
  php artisan key:generate
  php artisan migrate
  php artisan db:seed --no-interaction --class=UsersTableSeeder
  php artisan db:seed --no-interaction --class=UserTypesTableSeeder
  php artisan db:seed --no-interaction --class=CategoriesTableSeeder
  php artisan db:seed --no-interaction --class=ProductsTableSeeder