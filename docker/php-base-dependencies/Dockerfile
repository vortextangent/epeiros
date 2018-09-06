FROM php:7.0.12-fpm-alpine

ENV RDKAFKA_VERSION=0.9.1 \
    PHPRDKAFKA_VERSION=2.0.1 \
    PHP_FAMILY=php7 \
    TIMEZONE=America/New_York \
    PHP_MEMORY_LIMIT=512M \
    MAX_UPLOAD=10M \
    PHP_MAX_FILE_UPLOAD=10 \
    PHP_MAX_POST=100M \
    APP_HOME='/data/php/application' \
    XDEBUG_PORT=9000

COPY ./sys/*.tar.gz /tmp/
RUN apk upgrade --no-cache --update \
 && apk add --no-cache --virtual dependencies \
        bzip2 \
        curl \
        freetype \
        icu \
        libbz2 \
        libjpeg-turbo \
        libmcrypt \
        libpng \
        libxml2 \
        openssl \
        sqlite \
 && apk add --no-cache --virtual tools \
        apache-ant \
        bash \
        util-linux \
 && apk add --no-cache --virtual .build-deps \
        alpine-sdk \
        autoconf \
        bzip2-dev \
        curl-dev \
		freetype-dev \
        g++ \
        git \
        icu-dev \
        libjpeg-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libxml2-dev \
        make \
        openssl-dev \
        openssh \
        python \
        sqlite-dev \
        ssmtp \
 && docker-php-ext-install \
        bz2 \
        intl \
        mcrypt \
        mysqli \
        opcache \
        pcntl \
        pdo_mysql \
        xmlrpc \
        xsl \
        zip \
 && pecl install apcu xdebug trader xsl \
 && docker-php-ext-enable bz2 xdebug \
 && sed -i '1 a xdebug.remote_autostart=false' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && sed -i '1 a xdebug.remote_port=${XDEBUG_PORT}' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && sed -i '1 a xdebug.remote_enable=1' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && tar -xzf /tmp/librdkafka-${RDKAFKA_VERSION}.tar.gz -C /tmp \
 && cd /tmp/librdkafka-${RDKAFKA_VERSION} \
 && ./configure \
 && make \
 && sudo make install \
 && cd / \
 && pecl install rdkafka-${PHPRDKAFKA_VERSION} \
 && docker-php-ext-enable rdkafka \
 && apk del .build-deps \
 && find / -type f -iname \*.apk-new -delete \
 && rm -rf /var/cache/apk/* \
 && rm -rf /tmp/** \

EXPOSE ${XDEBUG_PORT}

