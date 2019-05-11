FROM php:7.2-fpm

RUN apt-get update

RUN DEBIAN_FRONTEND=noninteractive apt-get install -q -y --no-install-recommends apt-transport-https zlib1g-dev libicu-dev g++
RUN DEBIAN_FRONTEND=noninteractive apt-get install -q -y --no-install-recommends apt-transport-https advancecomp pngcrush gifsicle jpegoptim
RUN DEBIAN_FRONTEND=noninteractive apt-get install -q -y --no-install-recommends apt-transport-https libjpeg-progs libimage-exiftool-perl
RUN DEBIAN_FRONTEND=noninteractive apt-get install -q -y --no-install-recommends apt-transport-https pngnq libpng-dev
RUN DEBIAN_FRONTEND=noninteractive apt-get install -q -y --no-install-recommends apt-transport-https optipng pngquant

# install PHP extensions
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install bcmath && docker-php-ext-enable bcmath
RUN docker-php-ext-install exif && docker-php-ext-enable exif
RUN docker-php-ext-install gd && docker-php-ext-enable gd
RUN docker-php-ext-install mbstring && docker-php-ext-enable mbstring
RUN docker-php-ext-install intl && docker-php-ext-enable intl

COPY ./php.ini $PHP_INI_DIR/php.ini
