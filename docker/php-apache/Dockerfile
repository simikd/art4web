FROM php:8.2-apache

# update and upgrade
RUN apt-get update
RUN apt-get -y upgrade

# install necessary packages
RUN apt-get -y install build-essential curl wget libpng-dev libzip-dev libxml2-dev git vim

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Composer
RUN wget -O - https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer

# nodejs
RUN wget -O - https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# enable mod rewrite
RUN a2enmod rewrite

COPY init.sh /init.sh
RUN chmod +x /init.sh

ENTRYPOINT ["/init.sh"]
