FROM php:7.3-apache

RUN usermod -u 1000 www-data \
  && groupmod -g 1000 www-data

RUN sed -i "s/\/var\/www/\/var\/www\/html/g" /etc/apache2/apache2.conf
RUN sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

RUN chown -R www-data:www-data /var/www/html
RUN chmod 777 -R /var/www/html
RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod authz_groupfile

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        cron \
        g++ \
        git \
        gcc \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libxml2-dev \
        libxslt1-dev \
        make \
        mc \
        supervisor \
        msmtp \
        msmtp-mta \
        tar \
        unzip \
        vim \
        wget \
        golang \
	libzip-dev \
    && rm -rf /var/lib/apt/lists/*
RUN pecl install mcrypt-1.0.2
RUN docker-php-ext-enable mcrypt

# RUN pecl install xdebug \
#   && docker-php-ext-enable xdebug

RUN docker-php-ext-configure \
  gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

RUN docker-php-ext-install \
    bcmath \
    gd \
    hash \
    intl \
    json \
    mbstring \
    mysqli \
    opcache \
    pdo \
    pdo_mysql \
    simplexml \
    soap \
    sockets \
    xsl \
    zip


RUN export LANG=ja_JP.UTF-8;

COPY conf/php.ini /usr/local/etc/php/
COPY msmtprc /etc/
COPY msmtprc /root/.msmtprc

# for msmtp ( not use in production!!!)
RUN echo 'sendmail_path = "/usr/sbin/sendmail -t"' > /usr/local/etc/php/conf.d/mail.ini

EXPOSE 80

WORKDIR /var/www/html
VOLUME /var/www/html
CMD ["apache2-foreground"]
