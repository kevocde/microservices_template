FROM php:8.2

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

COPY . /app
WORKDIR /app

CMD [ "php", "-S", "0.0.0.0:8001", "-t", "public" ]