FROM php:7-fpm
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get install -y --no-install-recommends apt-utils
RUN apt-get upgrade -y
RUN apt-get install msmtp msmtp-mta libjpeg62-turbo-dev libpng-dev libfreetype6-dev -y
RUN docker-php-ext-install pdo_mysql
# RUN docker-php-ext-install mbstring
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
ADD configs/msmtprc /etc/msmtprc
ADD configs/*.ini /usr/local/etc/php/conf.d/
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN chown www-data:www-data /etc/msmtprc
RUN chmod 0600 /etc/msmtprc