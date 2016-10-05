FROM ubuntu:trusty
MAINTAINER acev <aasisvinayak@gmail.com>

RUN apt-get update && apt-get install -y \
apache2-bin \
libapache2-mod-php5 \
php5-curl \
php5-ldap \
php5-sqlite \
php5-mysql \
php5-mcrypt \
php5-gd \
patch \
curl \
nano \
vim \
git \
mysql-client

RUN php5enmod mcrypt
RUN php5enmod gd

RUN sed -i 's/variables_order = .*/variables_order = "EGPCS"/' /etc/php5/apache2/php.ini
RUN sed -i 's/variables_order = .*/variables_order = "EGPCS"/' /etc/php5/cli/php.ini

RUN useradd --uid 1000 --gid 50 docker

RUN echo export APACHE_RUN_USER=docker >> /etc/apache2/envvars
RUN echo export APACHE_RUN_GROUP=staff >> /etc/apache2/envvars

COPY core/docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf
#RUN a2ensite 001-default-ssl.conf

COPY . /var/www/html

RUN a2enmod rewrite

WORKDIR /var/www/html
COPY core/docker/docker.env /var/www/html/core/.env

RUN chown -R docker /var/www/html

RUN service apache2 start

RUN cd /tmp;curl -sS https://getcomposer.org/installer | php;mv /tmp/composer.phar /usr/local/bin/composer

RUN cd /var/www/html/;composer install

RUN cd /var/www/html;php artisan key:generate
RUN cd /var/www/html;php artisan migrate
RUN cd /var/www/html;php artisan db:seed --no-interaction --class=UsersTableSeeder
RUN cd /var/www/html;php artisan db:seed --no-interaction --class=UserTypesTableSeeder
RUN cd /var/www/html;php artisan db:seed --no-interaction --class=CategoriesTableSeeder
RUN cd /var/www/html;php artisan db:seed --no-interaction --class=ProductsTableSeeder
RUN cd /var/www/html;php artisan db:seed --no-interaction --class=SettingsTableSeeder
RUN cd /var/www/html;php artisan db:seed --no-interaction --class=PluginsTableSeeder
RUN cd /var/www/html;php artisan db:seed --no-interaction --class=ThemesTableSeeder

COPY core/docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 80