FROM php:8.2-apache

# Установка необходимых зависимостей
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip exif pcntl

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка рабочего каталога
WORKDIR /var/www

# Копирование файлов приложения
COPY . /var/www

# Настройка прав доступа
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && a2enmod rewrite

# Копирование конфигурационного файла Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Генерация ключа приложения
RUN php artisan key:generate
