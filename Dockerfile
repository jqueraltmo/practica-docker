FROM php:8.2-apache

# Instal·lar extensions PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instal·lar i configurar SQLite com a BD alternativa
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev

# Crear directori per a la BD SQLite
RUN mkdir -p /var/www/data && chown www-data:www-data /var/www/data

# Copiar el codi
COPY html/ /var/www/html/

# Permetre .htaccess
RUN a2enmod rewrite

# Exposar port
EXPOSE 80

