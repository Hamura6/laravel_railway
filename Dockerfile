FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd bcmath pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Evitar advertencia ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Cambiar DocumentRoot al public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copiar solo composer files primero para cache de dependencias
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copiar el resto de la aplicación
COPY . .

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Ejecutar optimizaciones de Laravel (opcional pero recomendado)
RUN php artisan config:cache
RUN php artisan route:cache

EXPOSE 80