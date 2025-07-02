FROM php:8.2-apache

WORKDIR /var/www/html

# Instala dependências básicas + extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libicu-dev \          # Necessário para ext-intl
    zlib1g-dev \         # Necessário para ext-zip
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \               # Adiciona ext-intl
    zip                  # Adiciona ext-zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia arquivos do projeto
COPY . .

# Instala dependências (agora com as extensões disponíveis)
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Configura permissões
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

# Configura Apache
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

CMD ["apache2-foreground"]