---
layout: single
sidebar:
  nav: "docs"
title:  "Getting Started"
date:   2016-09-18 16:20:01 +0100
share: true
permalink: /docs/quick-start-guide/
---


The best way to get started with FlyMyShop is to download the master branch from github.

<h2>Clone</h2> 

You either download the [zip file](https://github.com/aasisvinayak/flymyshop/archive/master.zip) or use git clone


If you have downloaded the zip file, unzip the file and then you can follow the instructions in [installation page](https://flymyshop.com/docs/installation/)

{% highlight shell %}
git clone git@github.com:aasisvinayak/flymyshop.git
{% endhighlight %}

if you want to clone via SSH or

{% highlight shell %}
git clone https://github.com/aasisvinayak/flymyshop.git
{% endhighlight %}

if you would like to clone it via HTTPS.

<h2>Installation</h2>

Once you cloned the repository, then proceed with the following steps:

{% highlight shell %}
cd flymyshop/core
cp .env.example .env
complete .env values (optional)
composer install
chmod -R 777 storage
php artisan key:generate
php artisan migrate  (if prompted say yes)
php artisan db:seed (if prompted say yes)
php artisan serve --port=8000 --host=localhost &
{% endhighlight %}

Different ways to installing FlyMyShop is further discussed in the [installation page](https://flymyshop.com/docs/installation/)


