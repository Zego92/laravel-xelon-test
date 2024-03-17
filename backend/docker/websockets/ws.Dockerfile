FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    wget \
    curl \
    git \
    libxml2-dev \
    zlib1g-dev \
    libevent-dev \
    openssl \
    libssl-dev \
    libgmp-dev \
    libicu-dev \
    libhiredis-dev \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    libfreetype6-dev \
    libonig-dev \
    zip \
    unzip \
    bison

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install xml sockets gmp intl pcntl

RUN docker-php-ext-configure tokenizer

RUN pecl install event

RUN docker-php-ext-enable event

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}
RUN groupmod -g ${PGID} www-data && \
    usermod -u ${PUID} www-data

USER www-data

EXPOSE 6001

CMD ["php", "artisan", "websockets:serve"]
