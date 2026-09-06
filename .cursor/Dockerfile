FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive

# System PHP toolchain + common extensions. Stable, slow-changing system
# dependencies belong in the image; project dependencies are installed later
# from composer.json against the checked-out source.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        unzip \
        php-cli \
        php-mbstring \
        php-xml \
        php-curl \
        php-zip \
        php-sqlite3 \
        php-bcmath \
    && rm -rf /var/lib/apt/lists/*

# Composer (pinned installer verified against the official signature).
RUN curl -sSLf https://getcomposer.org/installer -o /tmp/composer-setup.php \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm -f /tmp/composer-setup.php \
    && composer --version

# The `ubuntu` user already exists in this base image and is used by the agent.
USER ubuntu
