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

#### LINE認証

localhost/auth/line にアクセス

## Linter/Formatter

### Larastan (Linter)

```bash
vendor/bin/phpstan analyse
```

### Laravel Pint (Formatter)

```bash
vendor/bin/pint
```
