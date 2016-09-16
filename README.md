[![Build Status](https://travis-ci.org/aasisvinayak/flymyshop.svg?branch=master)](https://travis-ci.org/aasisvinayak/flymyshop)
[![Latest Stable Version](https://poser.pugx.org/aasisvinayak/shop/v/stable)](https://packagist.org/packages/aasisvinayak/shop)
[![License](https://poser.pugx.org/aasisvinayak/shop/license)](https://packagist.org/packages/aasisvinayak/shop)
<!--[![StyleCI](https://styleci.io/repos/66875598/shield)](https://styleci.io/repos/66875598)-->


# FlyMyShop

A free open source e-commerce platform for online merchants based on customised version of Laravel.

![FlyMyShop Demo](/thumbnail.png)

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
- Add plugins to extend the features (See master branch - v0.0.1 does not offer support for plugins)
- OS independent
- Laravel based

#Automated Installation and Shop Configuration

Please follow the steps below to install FlyMyShop on your web server

a. Download [this zip](https://github.com/aasisvinayak/flymyshop/releases/download/v0.0.1/flymyshop_v0.0.1.zip) file
b. Unzip and upload to your server
c. Visit the public folder
d. Follow the instructions

Please make sure that only public directory is visible to the outside world!

#  Installation Methods
 
 You can also install FlyMyShop in the following ways as well:

a. Manual

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

b. Using Composer

```
composer create-project --prefer-dist aasisvinayak/shop

```

c. Docker

```
docker pull aasisvinayak/flymyshop
```

Please make sure that Apache is running in your docker container if the shop fails to load.

#Get Started

If you have pull the release via composer, please go to the 'shop' folder and issue

```
php artisan serve --port 8000
```

The application will be available at http://localhost:8000


If you would like to try FlyMyShop using Apache or Nginx, please upload the whole directory to the web server and point the server root to the public folder inside the shop directory


#Database

The default is sqlite and you can change this to any other database as you please. For example, if you wish to use mysql please update the .env file as follows:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1		
DB_PORT=3306		
DB_DATABASE=database_name		
DB_USERNAME=username		
DB_PASSWORD=secret

```

#Seed Users

When you install the project, it creates two users for you:

test@example.com and 
user@example.com

The first one is an administrator and the second one a regular user. The default password for both are passw0rd. 
You can manually update the database to update the email.


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