# Laravel12+DockerでLINEログイン

PHP8.2 / Laravel12 / Docker
deploy環境はAWS App Runnerを想定、1つのコンテナでNginx＋php-fpmを動かす

## ローカル環境

### セットアップ

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
