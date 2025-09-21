# Laravel12+DockerでLINEログイン

PHP8.2 / Laravel12 / Docker  
deploy環境はAWS App Runnerを想定、1つのコンテナでNginx＋php-fpmを動かす

## ローカル環境

### セットアップ

#### .envファイル作成

.envファイルを作成

```bash
cp .env.example .env
```

.envファイルの `LINE_CLIENT_ID` 、 `LINE_CLIENT_SECRET` を書き換える

```php
LINE_CLIENT_ID=<your client id>
LINE_CLIENT_SECRET=<your client secret>
LINE_REDIRECT_URI=http://localhost:80/auth/line/callback
```

#### Docker Compose起動

```bash
docker compose up -d
```

### ローカル環境アクセス

localhost:80 にアクセス

#### LINEログイン

localhost/auth/line にアクセス

## Linter/Formatter の実行

### Larastan (Linter)

```bash
vendor/bin/phpstan analyse
```

### Laravel Pint (Formatter)

```bash
vendor/bin/pint
```
