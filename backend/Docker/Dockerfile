FROM php:8.2-fpm-bookworm

ARG user=user
ARG uid=1000

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql intl zip opcache \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# define o diretório de trabalho
WORKDIR /var/www

# Copy the contents of the backend folder (excluding those in .dockerignore) into the container
COPY ../.. /var/www/html

# expoem a porta para o xdebug
EXPOSE 9003

USER $user

CMD ["php-fpm"]
