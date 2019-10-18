FROM php:7.3-fpm
COPY php.ini /usr/local/etc/php/php.ini

# Install dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libzip-dev \
    zlib1g-dev \
    --no-install-recommends

# Install extensions
RUN docker-php-ext-install \
    zip \
    bcmath \
    pdo_mysql

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ユーザ追加
RUN useradd -m -s /bin/bash -u 1000 -g users admin
