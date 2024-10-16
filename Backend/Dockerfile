# Sử dụng hình ảnh PHP
FROM php:8.1-fpm

# Cài đặt các tiện ích cần thiết
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www

# Sao chép mã nguồn vào trong container
COPY . .

# Cài đặt các dependencies của Laravel
RUN composer install

# Chạy lệnh để cài đặt các extension cần thiết cho MySQL
RUN docker-php-ext-install pdo pdo_mysql
