FROM php:8.0-apache

RUN apt-get update && apt-get install -y git unzip zip curl
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache mysqli exif pcntl redis memcached

RUN a2enmod rewrite headers deflate ssl

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer
