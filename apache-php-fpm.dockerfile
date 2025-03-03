FROM httpd:2.4.59
RUN apt update
RUN apt install -y php8.2-fpm libjs-jquery-jfeed davical perl libcgi-session-perl
COPY start-apache-php-fpm.sh /usr/local/bin/start-apache-php-fpm.sh
CMD ["sh", "/usr/local/bin/start-apache-php-fpm.sh"]
