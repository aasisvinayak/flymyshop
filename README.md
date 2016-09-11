[![Build Status](https://travis-ci.org/aasisvinayak/shop.svg?branch=master)](https://travis-ci.org/aasisvinayak/shop)
[![Latest Stable Version](https://poser.pugx.org/aasisvinayak/shop/v/stable)](https://packagist.org/packages/aasisvinayak/shop)
[![License](https://poser.pugx.org/aasisvinayak/shop/license)](https://packagist.org/packages/aasisvinayak/shop)


# FlyMyShop

A free open source e-commerce platform for online merchants based on customised version of Laravel.

# Overview

FlyMyShop is a fully fledged e-commerce platform for online merchants. 

- Free and open source
- Users can view, search and buy products
- Admin has the ability to add,edit and remove products, categories and shop pages
- Integrated with Stripe
- Users can add multiple credit cards to their account
- Users can login using their facebook account
- Manage orders and payments
- Ability to refund orders
- Throttling to protect against brute force attacks
- reCAPTCHA to prevent abuse

# Features

- Add custom shop themes
- Add plugins to extend the features
- OS independent
- Laravel based


# Installation 

Automated installation will be added soon. In the mean time you can deploy this application by following the steps below:

  - cp .env.example .env
  - complete .env values 
  - composer install
  - chmod -R 777 storage
  - php artisan key:generate 
  - php artisan migrate 
  - php artisan key:generate
  - php artisan db:seed --no-interaction --class=UsersTableSeeder
  - php artisan db:seed --no-interaction --class=UserTypesTableSeeder
  - php artisan db:seed --no-interaction --class=CategoriesTableSeeder
  - php artisan db:seed --no-interaction --class=ProductsTableSeeder
  - php artisan serve --port=8000 --host=localhost &


# How to contribute

If you wish to contribute please fork the repository, edit and submit a pull request.

# License

GNU General Public License version 3 (GPLv3)

# Links

[Fly My Cloud Limited Homepage](https://www.flymycloud.com)
Demo (coming soon)

#Contributors

[Aasis Vinayak (acev)](https://aasisvinayak.com)