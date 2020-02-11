# RefutationKing
オリジナルアプリケーションについて

## 目的
・webサービスに不可欠な非同期実行を使用し、リアルタイムチャットを実装する。

・外部APIを使用する。(https://pusher.com/)

・飲み会で起こる議論が面白く、いろんな人の意見を見ることで勉強したいと思ったから。

・Twitterなどを見ていると議論は一定の需要があると考えたから。

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

  [✔︎]チャット機能作成(非同期処理)

  [✔︎]画面デザイン修正(レスポンシブ)

  [✔︎]第一次リリース(Heroku)👏🥇🎉

  [✔︎]各種バリデーション確認、修正
    []不正ルーム参加時対応

  [✔︎]デザイン修正(Webブラウザ)

  []テスト作成

  []投票機能実装

  []プロフィール作成機能実装

  []ルーム名修正機能（ルーム作成者のみ）

  []削除機能(管理者権限のあるもののみ)

  []デザイン修正(モバイル)

# ローカル環境構築方法(Docker-laradock)

## Git clone
まずは、このリポジトリをクローンします。
`git clone https://github.com/Ryota-Tabuse/RefutationKing`
カレントディレクトリを変更する
`cd RefutationKing`

## Submodule更新
submoduleであるlaradockフォルダが空になっています。
1. `git submodule init`
2. `git submodule update`
上記コマンドで、laradockの資材を落としてくることができます。

## envファイル修正
`cd laradock`
`cp env-example .env`
`cp env-example .env`
・ APP_CODE_PATH_HOST=../
-> APP_CODE_PATH_HOST=../src

## docker構築
`docker-compose up -d workspace nginx`
`docker-compose up -d postgres`

・docker-compose.ymlの修正
```
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=homestead
- DB_USERNAME=homestead
- DB_PASSWORD=secret
+ DB_CONNECTION=pgsql
+ DB_HOST=postgres
+ DB_PORT=5432
+ DB_DATABASE=default
+ DB_USERNAME=default
+ DB_PASSWORD=secret
```

## migrate
`docker-compose exec workspace bash`
`composer install`
`php artisan key:generate`

## 動作確認
以上の設定で、localhostで動作を確認することが可能。
`http://localhost/`
※チャットルームをリアルタイムチャット化する場合は、別途PUSHERの設定が必要。
