FROM php:7.4-apache

# Activate the rewrite_module
RUN a2enmod rewrite

# Install packages
RUN apt-get update && apt-get install --no-install-recommends -y \
      libjpeg-dev \
      libpng-dev \
      libpq-dev \
      curl \
      wget \
      vim \
      git \
      unzip \
      default-mysql-client \
      ruby-full \
    && rm -rf /var/lib/apt/lists/*;

# From the official docker image
RUN docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
    docker-php-ext-install -j "$(nproc)" \
      gd \
      opcache \
      pdo_mysql \
      pdo_pgsql \
      #zip \
    ;

# Install SASS tools
RUN gem install compass

# Set workdir to webroot
WORKDIR /var/www/html
COPY public_html /var/www/html/
