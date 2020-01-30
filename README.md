# RefutationKing
自作Webアプリケーションについて

## 目標
・非同期実行を使用し、リアルタイムチャット化する
https://pusher.com/

## RefutationKing Task
[✔︎]必要機能洗い出し

[✔︎]画面要件整理

[✔︎][DB設計]

![./doc/Entity%20Relationship%20Diagram.png](./doc/Entity%20Relationship%20Diagram.png)

[✔︎]開発タスク分割

### []開発タスク

  [✔︎]Docker環境構築

  [✔︎]DB接続

  [✔︎]DBテーブル、項目作成
  
  [✔︎]フェイクデータ作成
  
  [✔︎]ユーザログイン機能作成
  
  [✔︎]お題一覧画面表示機能実装
  
  [✔︎]ルーム一覧表示作成

  [✔︎]ルーム作成機能実装
  
  [✔︎]チャット機能作成(同期処理)

  [取組中]チャット機能作成(非同期処理)  

  []画面デザイン修正(レスポンシブ)
  
  []第一次リリース(Heroku)
  
  []投票機能実装
  
  
  []プロフィール作成機能実装
  
  []テスト作成
  
  []各種バリデーション確認、修正

# 環境構築(Docker-laradock)

## laradock

1. git submodule add [https://github.com/Laradock/laradock.git](https://github.com/Laradock/laradock.git)
2. cd laradock
3. cp env-example .env 
envファイルをexmapleからコピーして作成
4. APP_CODE_PATH_HOST=../src

*** envは機密情報のため、Gitにあげないよう注意！ ***

## Docker立ち上げ
1. `docker-compose up -d workspace nginx`

## **Laravelアプリの構築**
1. `docker-compose exec workspace bash`
2. `composer create-project laravel/laravel . --prefer-dist`
3. `exit`
⇨localhostにアクセス可能になる。

## DB設定
1. `docker-compose up -d postgres`

## DB接続設定
1.src配下に生成されている「.env」ファイルを編集

## Docker確認コマンド
`docker-compose ps`

# Heroku

1. `heroku login`
2. `heroku create <アプリ名>`
3. 管理画面にAppが生成されていることを確認

    ![https://s3-us-west-2.amazonaws.com/secure.notion-static.com/f5719b4f-5d9e-4760-8c7a-8df0a0579d27/_2020-01-29_23.24.32.png](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/f5719b4f-5d9e-4760-8c7a-8df0a0579d27/_2020-01-29_23.24.32.png)

# アドオンを追加

・対象のアプリを選び遷移先で、Resourcesタブを押下。

・postgressを検索して追加

![https://s3-us-west-2.amazonaws.com/secure.notion-static.com/18ac9160-d445-432e-a160-8253bb243290/_2020-01-29_23.29.14.png](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/18ac9160-d445-432e-a160-8253bb243290/_2020-01-29_23.29.14.png)

※10000レコードしか保存できない点は要注意

# データベース接続

上記で登録したアドオンのpostgressに接続します。その前に接続先の情報を確認。

    heroku config:get DATABASE_URL

下記のような形で表示されます。
postgres://DB_USERNAME:DB_PASSWORD@DB_HOST:5432/DB_DATABASE

※.envはセンシティブな情報を含むのでGitには配置しない。

そのため、Herokuでの設定は別途管理画面が用意されている。

git configコマンドで設定を行う。

    $ heroku config:set DB_CONNECTION=pgsql
    $ heroku config:set DB_HOST=DB_HOST
    $ heroku config:set DB_DATABASE=DB_DATABASE
    $ heroku config:set DB_USERNAME=DB_USERNAME
    $ heroku config:set DB_PASSWORD=DB_PASSWORD
    (DB_CONNECTION以外の右側は上記config:getで得た情報を記述)

・Procfile(Herokuの設定ファイル)を作成する　コマンドで作成。ディレクトリはsrcフォルダの並列(プロジェクト最上位で良い)

    touch ./Procfile

・下記一文をProcfileに記述し、src配下に配置

    web: vendor/bin/heroku-php-apache2 public/　

# Git push heroku master

> No default language could be detected for this app.

上記エラーが発生。

(参考)[https://team-lab.github.io/skillup/step2/10-heroku.html](https://team-lab.github.io/skillup/step2/10-heroku.html)

APP_KEYの設定がうまくいっていませんでした。artisanコマンドを使用するため、laradockディレクトリに移動して、KEYを生成してみます。

    
    base64:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

上記のようなKEYが生成されたので、それを設定してあげます。

    $ RefutationKing % heroku config:set APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXX   
    Setting APP_KEY and restarting ⬢ refutation-king... done, v12
    APP_KEY: base64:XXXXXXXXXXXXXXXXXXXXXXXX

階層を一つあげ、プロジェクト最上位に移動してください。

# 次こそGitPush

    git subtree push --prefix src/ heroku master

app/配下をデプロイするコマンド。
ついに公開できた！！！が、
その影響か、CSS、Bootstrapなどが効いていない様子。。。

とりあへず次へ。

# マイグレーション

1.migrateをherokuにダウンロード

    heroku run "php artisan migrate:install"

2.Herokuにマイグレーションファイルがあることを確認

    heroku run "php artisan migrate"
    yesを入力！

これで完璧！！！

・Pusher Channelsも追加。

![https://s3-us-west-2.amazonaws.com/secure.notion-static.com/23c4f09b-b48a-48a5-b1d0-19e5cd45df7f/_2020-01-29_23.34.17.png](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/23c4f09b-b48a-48a5-b1d0-19e5cd45df7f/_2020-01-29_23.34.17.png)

・PusherチャンネルにてAPPKEYなどを確認し、Herokuに登録

    heroku config:set PUSHER_APP_ID=XXXXXXXXXXX
    heroku config:set PUSHER_APP_KEY=XXXXXXXXXXX
    heroku config:set PUSHER_APP_SECRET=XXXXXXXXXXX
    heroku config:set PUSHER_APP_CLUSTER=XXX
    //ブロードキャストをpusherに変更
    heroku config:set BROADCAST_DRIVER=pusher

これでできました！

動いた〜〜〜〜〜〜〜〜〜