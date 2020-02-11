# RefutationKing(論破王)
https://refutation-king.herokuapp.com/
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
  -[✔︎]不正ルーム参加時対応(consoleからの不正入室)

  [✔︎]デザイン修正(Webブラウザ)

  [取組中]テスト作成

  []投票機能実装

  []プロフィール作成機能実装

  []ルーム名修正機能（ルーム作成者のみ）

  []削除機能(管理者権限のあるもののみ)

# ローカル環境構築方法(Docker-laradock)
※Dockerを使用できる環境を前提とする

## Git clone
まずは、このリポジトリをクローンします。
`git clone https://github.com/Ryota-Tabuse/RefutationKing`

## Submodule更新
submoduleであるlaradockフォルダが空になっています。
1. `git submodule init`
2. `git submodule update`
上記コマンドで、laradockの資材を落としてくることができます。

記述中...
