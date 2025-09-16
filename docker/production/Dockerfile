FROM php:8.2-fpm

# 必要パッケージ & PHP拡張インストール
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install mbstring zip bcmath exif pcntl opcache \
    && rm -rf /var/lib/apt/lists/*

# Composerインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www
COPY ../../ /var/www

RUN composer install --no-dev --optimize-autoloader \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# .envがなければコピーしてキー生成
# RUN if [ ! -f .env ]; then cp .env.example .env; fi
# RUN php artisan key:generate

# Nginx設定
COPY ./docker/production/nginx.conf /etc/nginx/nginx.conf

# Supervisorの設定（nginxとphp-fpm同時起動）
COPY ./docker/production/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# App Runnerが見るポート
EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

