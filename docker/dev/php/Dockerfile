FROM php:7.4.21-fpm-alpine3.13

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG DOCKER_TIMEZONE=${DOCKER_TIMEZONE}
ARG DEBUGMODE=1

ENV PS1="\u@\h:\w\\$ "

RUN echo "${DOCKER_TIMEZONE}" > /etc/timezone

RUN echo -n "With debug:          " ; if [[ "${DEBUGMODE}" = "on" ]] ;      then echo "Yes"; else echo "No" ; fi && \
    if [ -z ${USER_ID+x} ]; then echo "USER_ID is unset"; USER_ID=1000; else echo "USER_ID is set to '$USER_ID'"; fi && \
    if [ -z ${GROUP_ID+x} ]; then echo "GROUP_ID is unset"; GROUP_ID=1000; else echo "GROUP_ID is set to '$GROUP_ID'"; fi

RUN apk update \
 && apk add --no-cache $PHPIZE_DEPS \
    bash \
    git \
    unzip libxml2-dev yarn

RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-install xml

# PHP extensions
RUN docker-php-ext-install opcache pdo pdo_mysql mysqli
RUN docker-php-ext-enable opcache
RUN apk add icu-dev
RUN docker-php-ext-configure intl && docker-php-ext-install intl

# Enable GD
RUN apk add --no-cache libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev && docker-php-ext-install gd && apk del libpng-dev
RUN apk add --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
        && pecl install apcu \
        && docker-php-ext-enable apcu \
        && pecl clear-cache \
        && apk del .build-dependencies
# Enable LDAP
RUN  apk add --update --no-cache \
          libldap && \
      # Build dependancy for ldap \
      apk add --update --no-cache --virtual .docker-php-ldap-dependancies \
          openldap-dev && \
      docker-php-ext-configure ldap && \
      docker-php-ext-install ldap && \
      apk del .docker-php-ldap-dependancies && \
      php -m;

#
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# xdebug extensions
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
#

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN rm -rf /var/cache/apk/*
#
WORKDIR /usr/src/app
COPY . /usr/src/app
RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin
