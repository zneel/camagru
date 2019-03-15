FROM php:7-fpm
RUN apt install msmtp
ADD configs/.msmtprc /root/.msmtprc
ADD configs/*.ini /usr/local/etc/php/conf.d/
RUN chown www-data:www-data /root/.msmtprc
RUN chmod 600 /root/.msmtprc
RUN docker-php-ext-install pdo_mysql