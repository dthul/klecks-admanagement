FROM php:7.0-cli AS builder

WORKDIR /usr/opt/app

# Install NPM for Debian Stretch (php:7.0)
RUN apt-get update && \
    apt-get install -y gnupg && \
    sh -c 'echo "deb http://deb.debian.org/debian stretch-backports main" >> /etc/apt/sources.list' && \
    gpg --keyserver pgp.mit.edu --recv-keys 648ACFD622F3D138 0E98404D386FA1D9 && \
    gpg --armor --export 648ACFD622F3D138 | apt-key add - && \
    gpg --armor --export 0E98404D386FA1D9 | apt-key add - && \
    apt-get update && \
    apt-get install -y -t stretch-backports npm && \
    apt-get remove -y gnupg && \
    apt-get autoremove -y && \
    rm -rf /var/lib/apt/lists/*

# # Install NPM for Debian Buster (php:7.2)
# RUN apt-get update && \
#     apt-get install -y npm && \
#     rm -rf /var/lib/apt/lists/*

# Install Yarn
RUN npm install --global yarn

# Install PHP extensions
RUN apt-get update && \
    apt-get install -y libpq-dev libxml2-dev && \
    docker-php-ext-install mbstring pgsql xml tokenizer && \
    rm -rf /var/lib/apt/lists/*

# Get Composer (2.2 is the latest version that works with PHP 7.0)
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# Install Yarn specified deps
COPY package.json ./package.json
COPY yarn.lock ./yarn.lock
RUN yarn install

# # Install Composer specified deps
# COPY composer.json ./composer.json
# COPY composer.lock ./composer.lock
# RUN composer install --no-interaction --no-dev

# Build the Klecks app
COPY . .
# RUN php artisan config:cache
# RUN php artisan route:cache
# RUN php artisan view:cache
RUN composer install --no-interaction --no-dev --optimize-autoloader
RUN npm run prod

FROM php:7.0-apache AS app

WORKDIR /var/html/www

ENV APACHE_DOCUMENT_ROOT /var/html/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

# Install system requirements (we need libpq-dev in at least version 10, which Debian Stretch does not provide, so we add a Postgres repo here)
RUN apt-get update && \
    apt-get install -y curl ca-certificates gnupg && \
    sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt stretch-pgdg main" > /etc/apt/sources.list.d/pgdg.list' && \
    curl --insecure https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /etc/apt/trusted.gpg.d/apt.postgresql.org.gpg >/dev/null && \
    apt-get update && \
    apt-get install -y libpq-dev libxml2-dev && \
    apt-get remove -y ca-certificates gnupg && \
    apt-get autoremove -y && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mbstring pdo_pgsql pgsql xml tokenizer

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=builder /usr/opt/app/app ./app
COPY --from=builder /usr/opt/app/bootstrap ./bootstrap
COPY --from=builder /usr/opt/app/config ./config
COPY --from=builder /usr/opt/app/database ./database
# COPY --from=builder /usr/opt/app/artisan /usr/opt/app/.env.example ./.env
COPY --from=builder /usr/opt/app/public ./public
COPY --from=builder /usr/opt/app/resources ./resources
COPY --from=builder /usr/opt/app/routes ./routes
COPY --from=builder /usr/opt/app/storage ./storage
COPY --from=builder /usr/opt/app/vendor ./vendor
COPY --from=builder /usr/opt/app/artisan /usr/opt/app/server.php ./

RUN chown -R www-data:www-data ./storage
RUN chown -R www-data:www-data ./bootstrap/cache

# TODO: run migration automatically?
# php artisan migrate --force