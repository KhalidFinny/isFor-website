FROM php:apache

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pdo_sqlsrv sqlsrv xdebug

RUN a2enmod rewrite