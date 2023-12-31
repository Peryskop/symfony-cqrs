FROM php:8.2-fpm-alpine

RUN apk update \
 && apk add --no-cache $PHPIZE_DEPS \
    bash \
    git \
    zip \
    unzip \
    rsyslog \
    tzdata \
    zlib-dev \
    libxml2-dev \
    libzip-dev \
    linux-headers

RUN touch /var/log/schedule.log
RUN chmod 0777 /var/log/schedule.log

ADD crontab /etc/crontabs/root

RUN pecl install xdebug

RUN docker-php-ext-install pdo_mysql mysqli zip opcache

RUN docker-php-ext-enable opcache xdebug

RUN adduser -D -u 1000 docker && echo "docker:docker" | chpasswd

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# Set timezone
ENV TIMEZONE=UTC
RUN ln -s /usr/share/zoneinfo/$TIMEZONE /etc/localtime && echo $TIMEZONE > /etc/timezone
RUN "date"

CMD crond -b && rsyslogd && php-fpm
