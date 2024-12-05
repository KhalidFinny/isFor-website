FROM php:8.1-fpm-bullseye

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_sqlsrv sqlsrv xdebug

RUN addgroup -gid 1000 --system host
RUN adduser --ingroup host --system --disabled-password --shell /bin/sh -u 1000 host