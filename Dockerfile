# AppRunnerで動かす想定、1つのコンテナでNginx+php-fpmを動かす

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
COPY . /var/www

# Laravel の依存関係インストール
RUN composer install --no-dev --optimize-autoloader \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# supervisordログファイル用のディレクトリ作成（rootで実行されるため）
RUN mkdir -p /var/log/supervisor \
    && touch /var/log/supervisor/supervisord.log \
    && chown -R root:root /var/log/supervisor

# Nginx設定
COPY docker/production/nginx.conf /etc/nginx/nginx.conf

# Supervisorの設定
COPY docker/production/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# COPY docker/production/start-container /usr/local/bin/start-container
# RUN chmod +x /usr/local/bin/start-container

# スタートスクリプトを直接作成（COPYではなく）
RUN cat > /usr/local/bin/start-container << 'EOF'
#!/bin/bash
cd /var/www
export CACHE_STORE=file
export SESSION_DRIVER=file
php artisan config:clear || true
php artisan cache:clear || true
php artisan config:cache
php artisan route:cache
php artisan view:cache
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
EOF

RUN chmod +x /usr/local/bin/start-container

# App Runnerが見るポート
EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/start-container"]
