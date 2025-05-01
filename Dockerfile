FROM php:8.4.1
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y libpq-dev

RUN php -m | grep mbstring
WORKDIR /var/www/html
RUN docker-php-ext-install pdo pdo_pgsql
COPY . .

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
