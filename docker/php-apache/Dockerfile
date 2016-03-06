FROM php:5.6-apache

COPY challengeMe.conf /etc/apache2/sites-available/challengeMe.conf
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
COPY php.ini /usr/local/etc/php/conf.d/user.ini

RUN a2ensite challengeMe

RUN apt-get update \
    && apt-get install -y \
        libpq-dev \
        libicu-dev \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        git \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install intl mbstring zip gd \
    && pecl install mongo mongodb \
    && docker-php-ext-enable mongo mongodb \
    && apt-get clean \
    && rm -r /var/lib/apt/lists/*

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

