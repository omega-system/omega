FROM php:7

RUN apt-get update && apt-get install -y \
    git \
    nodejs \
    wget \
    zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    mbstring \
    pdo_mysql \
    zip \
  && curl https://getcomposer.org/installer | php

ADD package.json package.json
RUN npm install -g gulp && npm install && gulp \
  && npm uninstall -g gulp \
  && rm -r node_modules public/dist \

ADD composer.json composer.json
ADD composer.lock composer.lock
RUN php composer.phar install --no-dev --no-autoloader --no-scripts \
  && mkdir -p storage/app/public \
  && mkdir -p storage/framework/cache \
  && mkdir -p storage/framework/sessions \
  && mkdir -p storage/framework/views \
  && mkdir -p storage/logs

ADD . .

RUN php composer.phar dump-autoload -o \
  && rm composer.phar \
  && cp .env.example .env \
  && php artisan key:generate

ADD entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
EXPOSE 8000
