# RefutationKing
自作Webアプリケーションについて

## 目標
・非同期実行を使用し、リアルタイムチャット化する

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

  []ルーム作成機能実装
  
  []チャット機能作成(同期処理)
  
  []画面デザイン修正(レスポンシブ)
  
  []第一次リリース(Heroku)
  
  []投票機能実装
  
  []チャット機能作成(非同期処理)
  
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
