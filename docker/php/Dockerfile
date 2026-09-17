
# =====================================================================
# SkillSwap - environnement PHP
#
# Apache + PHP 8.5.10
#
# Cette image est prévue pour :
#   - les premiers TP PHP
#   - MySQL
#   - Composer
#   - le futur passage à Symfony
# =====================================================================

FROM php:8.5.10-apache


# ---------------------------------------------------------------------
# Extensions et outils système
# ---------------------------------------------------------------------
#
# pdo_mysql : connexion PHP -> MySQL
# intl      : internationalisation, nécessaire pour Symfony
# zip       : gestion des archives et dépendances Composer
# opcache   : accélération de l'exécution PHP
# unzip     : utilisé notamment par Composer
# git       : nécessaire pour certaines dépendances Composer

# RUN apt-get update \
#     && apt-get install -y --no-install-recommends \
#         libicu-dev \
#         libzip-dev \
#         unzip \
#         git \
#     && docker-php-ext-install \
#         pdo_mysql \
#         intl \
#         zip \
#         opcache \
#     && rm -rf /var/lib/apt/lists/*


# ---------------------------------------------------------------------
# Réécriture d'URL
# ---------------------------------------------------------------------
#
# Nécessaire pour :
#   - le front controller PHP
#   - les .htaccess
#   - le futur fonctionnement de Symfony
#
RUN a2enmod rewrite


# ---------------------------------------------------------------------
# Racine web
# ---------------------------------------------------------------------
#
# Le projet complet est monté dans :
#
#   /var/www/html
#
# Mais Apache ne doit exposer que :
#
#   /var/www/html/public
#
# Les dossiers suivants ne sont donc pas directement accessibles
# depuis le navigateur :
#
#   /inc
#   /cli
#   /data
#   /sql
#   etc.
#
# Cette organisation correspond également à celle utilisée par Symfony.
#
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public


# Modification de la configuration Apache pour utiliser public/
RUN sed -ri \
        -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/sites-available/*.conf \
    && sed -ri \
        -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}/!g' \
        /etc/apache2/apache2.conf \
        /etc/apache2/conf-available/*.conf


# ---------------------------------------------------------------------
# Autorisation des .htaccess
# ---------------------------------------------------------------------
#
# Les règles de réécriture placées dans public/.htaccess pourront
# être utilisées par Apache.
#
RUN { \
        echo '<Directory ${APACHE_DOCUMENT_ROOT}>'; \
        echo '    AllowOverride All'; \
        echo '    Require all granted'; \
        echo '</Directory>'; \
    } > /etc/apache2/conf-available/skillswap.conf \
    && a2enconf skillswap


# ---------------------------------------------------------------------
# Configuration PHP de développement
# ---------------------------------------------------------------------
#
# Les erreurs PHP sont volontairement visibles pendant le développement.
#
# NE PAS utiliser cette configuration telle quelle en production.
#
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"


# ---------------------------------------------------------------------
# Composer
# ---------------------------------------------------------------------
#
# Composer est intégré directement dans le conteneur.
#
# Cela permettra notamment :
#
#   docker compose exec web composer install
#
# puis, lors du passage à Symfony :
#
#   composer require ...
#
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# ---------------------------------------------------------------------
# Répertoire de travail
# ---------------------------------------------------------------------

WORKDIR /var/www/html