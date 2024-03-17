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
    && \
    docker-php-ext-install \
        pcntl \
        tokenizer \
        xml \
        sockets \
        gmp \
        intl \
        && \
    # Libevent
    pecl install event && \
    docker-php-ext-enable event && \
    # phpiredis
    apt-get install -y libhiredis-dev && \
    git clone https://github.com/nrk/phpiredis.git && \
    ( \
        cd phpiredis && \
        phpize && \
        ./configure --enable-phpiredis && \
        make && make install && \
        docker-php-ext-enable phpiredis \
    ) && \
    rm -rf phpiredis && \
    # Cleanup
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    mkdir -p /var/www

# Add non-root user, prevents files being created with root permissions on host machine
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}
RUN groupmod -g ${PGID} www-data && \
    usermod -u ${PUID} www-data

USER www-data

EXPOSE 6001

CMD ["php", "artisan", "websockets:serve"]
