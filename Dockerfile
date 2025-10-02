# Base image avec PHP 8.2 et Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    # Nettoyage après installation
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_mysql zip mbstring \
    && a2enmod rewrite

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

#################################################################
# CHANGEMENTS CLÉS POUR RÉSOUDRE L'ERREUR DE FICHIER MANQUANT ET CACHE
#################################################################

# 1. Copier uniquement les fichiers de dépendances pour le cache Docker
# Cela garantit que les fichiers sont là pour 'composer install'
COPY composer.json composer.lock ./

# 2. Installer les dépendances PHP via Composer
# Cette couche ne sera reconstruite que si composer.json ou composer.lock change
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 3. Copier tout le reste du code source
# Cette couche est reconstruite à chaque changement de code
COPY . .

# Exécuter les scripts post-installation de Laravel (clés d'application, etc.)
RUN composer run-script post-root-package-install

# 4. Assurer les permissions correctes
# Assurez-vous que les dossiers storage et cache sont accessibles
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port Apache
EXPOSE 80

# Démarrer Apache en mode foreground
CMD ["apache2-foreground"]