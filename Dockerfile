FROM composer:1.9.3 as vendor

WORKDIR /var/www/html

COPY ./ /var/www/html

RUN composer install --ignore-platform-reqs --optimize-autoloader --classmap-authoritative --no-dev

FROM php:7.4.3-apache-buster

ARG APP_ENV
ARG APP_DEBUG
ARG DATABASE_URL

ENV APP_ENV=$APP_ENV
ENV APP_DEBUG=$APP_DEBUG
ENV DATABASE_URL=$DATABASE_URL

WORKDIR /var/www/html

COPY . .
COPY --from=vendor /var/www/html/vendor /var/www/html/vendor
COPY --from=vendor /var/www/html/bootstrap/cache /var/www/html/bootstrap/cache

RUN cp "/var/www/html/docker/php/php.ini" "$PHP_INI_DIR/php.ini"
RUN cp "/var/www/html/docker/apache2/000-default.conf" "/etc/apache2/sites-available/000-default.conf"

RUN docker-php-ext-install -j$(nproc) \
	pdo_mysql \
	bcmath \
	opcache

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage

RUN php artisan migrate --force
RUN php artisan db:seed --class=CountrySeeder --force
RUN php artisan optimize

RUN a2enmod rewrite
