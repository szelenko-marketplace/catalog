FROM php:8.5-fpm

ARG APP_USER=app
ARG APP_UID=1000
ARG APP_GID=1000
ARG INSTALL_XDEBUG=0

# Встановлення системних залежностей
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libicu-dev libpq-dev bash \
    && docker-php-ext-install intl pdo pdo_mysql pdo_pgsql pgsql zip \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install redis && docker-php-ext-enable redis

# Встановлення Xdebug, якщо передано INSTALL_XDEBUG=1
RUN if [ "$INSTALL_XDEBUG" = "1" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug; \
fi

# ---- КОНФІГУРАЦІЇ (CLI + FPM)
COPY php/php.ini /usr/local/etc/php/conf.d/10-common.ini
COPY php/php-fpm.ini /usr/local/etc/php/conf.d/20-fpm.ini

# ---- CLI ONLY
RUN mkdir -p /usr/local/etc/php/cli-conf.d
COPY php/php-cli.ini /usr/local/etc/php/cli-conf.d/20-cli.ini

# ---- php-cli wrapper
RUN mv /usr/local/bin/php /usr/local/bin/php-bin \
 && printf '#!/bin/sh\nPHP_INI_SCAN_DIR="/usr/local/etc/php/conf.d:/usr/local/etc/php/cli-conf.d" exec /usr/local/bin/php-bin "$@"\n' \
    > /usr/local/bin/php \
 && chmod +x /usr/local/bin/php

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Створення користувача
RUN groupadd -g ${APP_GID} ${APP_USER} \
 && useradd -u ${APP_UID} -g ${APP_GID} -m -s /bin/bash ${APP_USER}

COPY home/bash_aliases /tmp/bash_aliases
RUN cat /tmp/bash_aliases >> /home/${APP_USER}/.bashrc \
    && rm /tmp/bash_aliases \
    && chown ${APP_USER}:${APP_GID} /home/${APP_USER}/.bashrc

WORKDIR /var/www/app

USER ${APP_USER}


ENV SHELL=/bin/bash
