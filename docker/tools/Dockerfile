FROM php:5.6

ENV SYMFONY_ENV dev

RUN apt-get update \
    && apt-get install -y \
        libpq-dev \
        libicu-dev \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        git \
    && curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin \
    && docker-php-ext-install intl mbstring zip gd \
    && pecl install mongo mongodb \
    && docker-php-ext-enable mongo mongodb \
    && apt-get clean \
    && rm -r /var/lib/apt/lists/*

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
COPY php.ini /usr/local/etc/php/conf.d/user.ini

RUN mkdir -p /var/www/html

WORKDIR /var/www/html/
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
