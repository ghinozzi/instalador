FROM docker.io/bitnami/laravel:9

RUN apt-get update && apt-get install -y git

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

COPY . .

RUN composer install
