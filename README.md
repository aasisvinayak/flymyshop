[![Build Status](https://travis-ci.org/aasisvinayak/flymyshop.svg?branch=master)](https://travis-ci.org/aasisvinayak/flymyshop)
[![Latest Stable Version](https://poser.pugx.org/aasisvinayak/shop/v/stable)](https://packagist.org/packages/aasisvinayak/shop)
[![License](https://poser.pugx.org/aasisvinayak/shop/license)](https://packagist.org/packages/aasisvinayak/shop)
<!--[![StyleCI](https://styleci.io/repos/66875598/shield)](https://styleci.io/repos/66875598)-->


# FlyMyShop

A free open source e-commerce platform for online merchants based on customised version of Laravel.

# Overview

FlyMyShop is a fully fledged e-commerce platform for online merchants. 

- Free and open source
- Users can view, search and buy products
- Admin has the ability to add, edit and remove products, categories and shop pages
- Integrated with Stripe
- Integrated with Telegram messaging (for order update)
- Users can add multiple credit cards to their account
- Social login - Users can login using their facebook account
- Manage orders and payments
- Ability to refund orders
- Throttling to protect against brute force attacks
- reCAPTCHA to prevent abuse
- Newsletter support (Integrated MailChimp)
- Multi-currency support

# Features

- Add custom shop themes
- Add plugins to extend the features
- OS independent
- Laravel based


# Installation 

1. Manual

Download the release and follow the steps below:

```
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
```

2. Using Composer

```
composer create-project --prefer-dist aasisvinayak/shop

```

3. Docker

```
docker pull aasisvinayak/flymyshop
```

Please make sure that Apache is running in your docker container if the shop fails to load.


#Testing

Run the tests with (please make sure the values for testing are filled in correctly in the config/database.php file and .env):

``` bash
vendor/bin/phpunit
```

# How to contribute

If you wish to contribute please fork the repository, edit and submit a pull request.

# License

GNU General Public License version 3 (GPLv3)

# Links

[Fly My Cloud Limited Homepage](https://www.flymycloud.com)
Demo (coming soon)

#Contributors

[Aasis Vinayak (acev)](https://aasisvinayak.com)