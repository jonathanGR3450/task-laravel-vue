FROM node:latest AS node
FROM php:8.1.0-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# copy composer.lock y composer.json a la carpeta /var/www/
COPY composer.* /var/www/

# work directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && pecl install redis && apt-get install -y  --no-install-recommends \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# install extensions
RUN docker-php-ext-install pdo pdo_pgsql zip exif pcntl
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# copy the code at folder with user permissions
COPY --chown=$user:$user . /var/www

# Configurar permisos de directorio
RUN chown -R $user:$user .

RUN npm install

# RUN npm run build
# RUN npm run dev

USER $user

# expose 9000 port
EXPOSE 9000

# execute php-fpm command, php-fpm run php server
CMD [ "php-fpm" ]