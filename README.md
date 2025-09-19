## ローカル環境

### セットアップ

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
