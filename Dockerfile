# Utiliser PHP 8.1 avec Apache (stable pour Laravel 8)
FROM php:8.1-apache

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances système et PHP nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier le code Laravel
COPY . .

# Installer les dépendances PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Configurer les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
