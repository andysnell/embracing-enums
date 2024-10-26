FROM php:8.3-cli

ENV PATH="/var/www/vendor/bin:/home/dev/composer/bin:$PATH"
ENV COMPOSER_HOME="/home/dev/composer"

RUN groupadd --gid 1000 dev \
  && useradd --system --create-home --uid 1000 --gid 1000 --shell /bin/bash dev \
  && mkdir -p "/home/dev/.composer" \
  && chown -R "dev:dev" "/home/dev/" \
  && echo "PS1='[\[\e[32m\]PHP8.3\[\e[0m\]]:\[\e[96m\]\w \[\e[0m\]\\$ '" >> "/home/dev/.bashrc" \
  && echo "alias c='clear'" >> "/home/dev/.bashrc" \
  && echo "error_reporting=E_ALL" >> "/usr/local/etc/php/conf.d/settings.ini" \
  && echo "display_errors=on" >> "/usr/local/etc/php/conf.d/settings.ini" \
  && echo "log_errors=on" >> "/usr/local/etc/php/conf.d/settings.ini"

RUN apt-get update \
  && apt-get install -y -q \
        apt-transport-https \
        autoconf \
        build-essential \
        curl \
        git \
        less \
        libxml2-dev \
        libzip-dev \
        pkg-config \
        unzip \
        zlib1g-dev \
  && apt-get clean

RUN docker-php-ext-install -j$(nproc) zip

COPY --link --from=composer/composer:latest-bin /composer /usr/bin/composer

USER dev
WORKDIR /app