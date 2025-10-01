# Base image avec PHP 8.2 et Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring \
    && a2enmod rewrite

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le code source Laravel
COPY . .

# Installer les dépendances PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Assurer les permissions correctes
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port Apache
EXPOSE 80

# Démarrer Apache en mode foreground
CMD ["apache2-foreground"]
