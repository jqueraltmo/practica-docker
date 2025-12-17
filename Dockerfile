FROM php:8.2-apache

# Instal·lar extensions PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite per a URLs amigables
RUN a2enmod rewrite

# Copiar aplicació
COPY html/ /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposar port 80
EXPOSE 80

