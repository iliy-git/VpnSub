FROM php:8.2-fpm

# Установка системных зависимостей для Laravel и SQLite
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Очистка кэша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка PHP расширений (pdo_sqlite вместо pdo_mysql)
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node.js для фронтенда (Vite)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www

# Мы НЕ копируем файлы здесь, так как они придут через volume в docker-compose
# Но создаем файл базы, если его нет, чтобы права выставились верно
RUN mkdir -p database && touch database/database.sqlite && chown -R www-data:www-data database

EXPOSE 8000

# Запускаем встроенный сервер Laravel (так как nginx не нужен)
CMD ["php-fpm"]
