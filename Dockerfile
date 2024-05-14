FROM php:8.2 as php

RUN apt update -y
    
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www
COPY . .
COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer
# Install PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-plugins --no-scripts
RUN chown -R www-data:www-data .
RUN chown -R www-data bootstrap/cache
ENV PORT=8000
ENTRYPOINT ["Docker/entrypoint.sh"]
