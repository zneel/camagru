FROM php:7-fpm-alpine
RUN apk add msmtp libpng-dev libjpeg-turbo-dev freetype-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mbstring
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
ADD configs/.msmtprc /var/.msmtprc
ADD configs/*.ini /usr/local/etc/php/conf.d/
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN chown www-data:www-data /var/.msmtprc
RUN chmod 600 /var/.msmtprc