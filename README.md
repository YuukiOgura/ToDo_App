# 環境構築手順

 
## 1. リポジトリのクローン
GitHubからクローンしてきます。  
```$ git clone https://github.com/YuukiOgura/ToDo_App.git ```

## 2. .envファイルの作成
.env.exampleをコピーし、.envファイルを作成してください。  

```$ cp .env.example .env```  

## Composerのインストール
## 2.1. .envファイルの編集
.envファイルの内容は、添付してありますGoogleドライブ内ToDoEnvをご覧ください。

## Composerのインストール
Composerは、GitHubに上がっていないvendorに含まれている為インストールします。  
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

## Preline UIのインストール

```$ ./vendor/bin/sail npm i preline```

## PusuerとLaravel Echo（インストール）
Pusherのインストールをします。　

```$ ./vendor/bin/sailcomposer require pusher/pusher-php-server```

Laravel Echo等必要なライブラリをインストールします。　

```$ ./vendor/bin/sail npm install --save laravel-echo pusher-js```

## Node.js（インストール）

```$ ./vendor/bin/sail npm install```

## Node.js（フロントのビルド）

```$ ./vendor/bin/sail npm run dev```　

Laravel9.18以降はデフォルトでViteの使用になっています。  
Node.jsでのパッケージ管理と開発環境のビルドを行う為にインストールとビルドを行いました。

## マイグレーション

```$ ./vendor/bin/sail artisan migrate:fresh --seed```  

マイグレーションを実行します。  　
ユーザー  
test1@email.com  
test2@email.com  
test3@email.com  
パスワード  
test1234  
でログインできます。

## アクセス

http://localhost/にアクセス。