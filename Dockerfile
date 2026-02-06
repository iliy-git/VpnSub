FROM php:8.2-cli

# Установка системных зависимостей и SQLite
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Очистка
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP (pdo_sqlite)
RUN docker-php-ext-install pdo_sqlite mbstring bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Команда для запуска встроенного сервера Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
