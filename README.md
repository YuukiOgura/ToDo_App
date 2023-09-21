# 環境構築手順

 
## 1. リポジトリのクローン
このように環境構築の手順をこちらにまとめていただけると嬉しいです！  
```$ git clone https://github.com/YuukiOgura/ToDo-App.git ```

## 2. .envファイルの作成
.env.exampleをコピーし、.envファイルを作成してください。  

```$ cp .env.example .env```  

## Composerのインストール
## 2.1. .envファイルの編集
.envファイルを以下の様に編集してください。  
```DB_HOST=mysql```  
```REDIS_HOST=redis```  
```MAIL_FROM_ADDRESS=hello@example.com```  

## Composerのインストール
Composerは、GitHubに上がっていないvendorに含まれている為インストールする。  
```
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

## Sailの立ち上げ

```$ ./vendor/bin/sail up -d ```

## マイグレーションの実行

```$ ./vendor/bin/sail artisan migrate```

## APP_KEYの生成

```$ ./vendor/bin/sail artisan key:generate```

## Node.js（インストール）

```$ ./vendor/bin/sail npm install```
## Node.js（フロントのビルド）

```$ ./vendor/bin/sail npm run dev```

Laravel9.18以降はデフォルトでViteの使用になっています。  
Node.jsでのパッケージ管理と開発環境のビルドを行う為にインストールとビルドを行いました。
## アクセス

http://localhost/にアクセス。