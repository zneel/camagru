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

# Okokowqdlq5qwd

# Bugs

# Send form recovery
# http://192.168.99.100:8080/reset_password.php?login=akarasso&key=
# http://192.168.99.100:8080/reset_password.php?login=&key=e15592bd09d4b3d64bd4f7a860d7c8efac7e89e5338f80c1449f90d6cd4f8f77
# php_1    | Stack trace:
# php_1    | #0 {main}
# php_1    |   thrown in /var/www/camagru/actions/reset_password.php on line 27

# Notice: Undefined index: key in /var/www/camagru/reset_password.php on line 43


# http://192.168.99.100:8080/reset_password.php?login=akarasso&key=e15592bd09d4b3d64bd4f7a860d7c8efac7e89e5338f80c1449f90d6cd4f8f77
# Prendre une photo
php_1    | NOTICE: PHP message: PHP Warning:  imagejpeg(/var/www/camagru/uploads/9ac34c478b3ee96382bc08089d9cac2f.jpg): failed to open stream: Permission denied in /var/www/camagru/actions/editor.php on line 61
nginx_1  | 192.168.99.1 - - [05/May/2019:16:33:05 +0000] "GET /editor.php HTTP/1.1" 200 7258 "http://192.168.99.100:8080/editor.php" "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36"
nginx_1  | 2019/05/05 16:33:17 [error] 6#6: *34 FastCGI sent in stderr: "PHP message: PHP Notice:  Only variables should be passed by reference in /var/www/camagru/actions/editor.php on line 98PHP message: PHP Warning:  imagejpeg(/var/www/camagru/uploads/9ac34c478b3ee96382bc08089d9cac2f.jpg): failed to open stream: Permission denied in /var/www/camagru/actions/editor.php on line 61" while reading response header from upstream, client: 192.168.99.1, server: php-docker.local, request: "POST /actions/editor.php HTTP/1.1", upstream: "fastcgi://172.18.0.3:9000", host: "192.168.99.100:8080", referrer: "http://192.168.99.100:8080/editor.php"


# Webcam
Uncaught TypeError: Cannot read property 'getContext' of null
    at snapshot (webcam.js:35)
    at HTMLButtonElement.onclick (editor.php:85)
snapshot @ webcam.js:35
onclick @ editor.php:85

actions/delete_image.php?image_id=1
# Delete image
php_1    | NOTICE: PHP message: PHP Notice:  Undefined index: page in /var/www/camagru/actions/delete_image.php on line 23
nginx_1  | 192.168.99.1 - - [05/May/2019:16:38:38 +0000] "GET /editor.php HTTP/1.1" 200 7258 "-" "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36"
nginx_1  | 2019/05/05 16:38:56 [error] 6#6: *48 FastCGI sent in stderr: "PHP message: PHP Notice:  Undefined index: page in /var/www/camagru/actions/delete_image.php on line 23" while reading response header from upstream, client: 192.168.99.1, server: php-docker.local, request: "GET /actions/delete_image.php?image_id=-1 HTTP/1.1", upstream: "fastcgi://172.18.0.3:9000", host: "192.168.99.100:8080"


nginx_1  | 2019/05/05 16:47:12 [error] 6#6: *146 FastCGI sent in stderr: "PHP message: PHP Notice:  Undefined index: comment_id in /var/www/camagru/actions/delete_comment.php on line 27" while reading response header from upstream, client: 192.168.99.1, server: php-docker.local, request: "GET /actions/delete_comment.php HTTP/1.1", upstream: "fastcgi://172.18.0.3:9000", host: "192.168.99.100:8080"
