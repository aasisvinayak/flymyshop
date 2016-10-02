---
title: "Installation"
sidebar:
  nav: "docs"
layout: single
excerpt: "Different ways of installing FlyMyShop"
sitemap: true
share: true
permalink: /docs/installation/
---


{% include toc icon="gears" title="Table of Contents" %}


You can  install FlyMyShop in many ways:


## Automatic (Stable)


Please follow the steps below to install FlyMyShop on your web server

1. Download  [this zip](https://github.com/aasisvinayak/flymyshop/releases/download/v0.0.2/flymyshop-v0.0.2.zip) file
2. Unzip and upload to your server 
3. Visit the public folder
4. Follow the instructions

Please make sure that only public directory is visible to the outside world!

## Composer (Stable)

<!--linenos-->

{% highlight shell %}
composer create-project --prefer-dist aasisvinayak/shop
{% endhighlight %}


## Github (Latest)


{% highlight shell %}
git clone https://github.com/aasisvinayak/flymyshop.git
cd flymyshop
composer install
cd core
cp .env.example .env
complete .env values (optional)
chmod -R 777 storage
php artisan key:generate 
php artisan migrate  (if prompted say yes)
php artisan db:seed (if prompted say yes)
php artisan serve --port=8000 --host=localhost &
{% endhighlight %}

## Docker (Stable)

{% highlight shell %}
docker pull aasisvinayak/flymyshop
{% endhighlight %}