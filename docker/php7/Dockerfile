FROM php:7.4.14-apache

#install nano text editor
RUN apt-get update
RUN apt-get install nano

#remove symbolic link logs
RUN rm /var/log/apache2/error.log
RUN rm /var/log/apache2/access.log

#enable apache modules
RUN a2enmod rewrite
RUN a2enmod headers

#disable default vireutal server configuration
RUN a2dissite 000-default

#install php extensions
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pdo_mysql
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
        && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
        && docker-php-ext-install gd

#create php info file
RUN printf "<?php\nphpinfo();" > /var/www/phpinfo.php

#start apache server
RUN service apache2 start

EXPOSE 80