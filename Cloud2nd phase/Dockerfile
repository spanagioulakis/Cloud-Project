FROM php:7.4-apache 
RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb \
 && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini 
