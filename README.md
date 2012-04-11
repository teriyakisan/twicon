twicon
==========================

Twitterユーザアイコンの画像URLを取得するPHPライブラリです。
API経由で画像URLを取得して、memcachedにキャッシュするのでAPIのアクセス制限を回避することができます。

使い方
-----
### 直接リダイレクトさせる

```php
$twicon = new Twicon();
$twicon->out($twitterId, $size);
```

[example](http://github.com/teriyakisan/twicon/blob/master/examples/images.php)

### imgタグに埋め込む

```php
$twicon = new Twicon();
$src = $twicon->getIconUrl($id, $size);
echo '<img src="' . $src . '" alt="" />';
```

[example](http://github.com/teriyakisan/twicon/blob/master/examples/html.php)

Twicon
----
### Twicon::out

    mixed Twicon:out ( int $id [,int $size = 0 ] )

TwitterのユーザアイコンURLに直接リダイレクトします。
呼び出しページがSSLの場合にはSSLのアイコンURLへリダイレクトします。

#### パラメータ

* id

    Twitter User ID

* size

    0: オリジナル画像（original）
    1: 小（mini）
    2: 中（normal）
    3: 大（bigger）

#### 返り値

成功した場合の返り値はありません。失敗した場合は、ダミーgifをバイナリ出力します。

### Twicon::getIconUrl

    mixed Twicon::getIconUrl ( int $id [,int $size = 0 [, bool $sslFlg = false ]] )

TwitterのユーザアイコンURL文字列を返します。

* id

    TwitterユーザID

* size

    0: オリジナル画像（original）
    1: 小（mini）
    2: 中（normal）
    3: 大（bigger）

* sslFlg

    trueを指定した場合はSSLのURLを返します。

#### 返り値

成功した場合に TRUE を、失敗した場合に FALSE を返します。

### Twicon::getMemcachedStatus

    bool Twicon::getMemcachedStatus ()

memcachedサーバの接続状態を返します。

#### 返り値

成功した場合に TRUE を、失敗した場合に FALSE を返します。

設定
----
`config/memcached.ini`は追加の設定ファイルです（ない場合はデフォルト設定で動きます）。
設定は`memcached`セクションに記述する必要があります。

* host

    memcachedサーバのホスト名

* port

    memcachedサーバのポート番号

* cache_expire_sec

    キャッシュの有効期間（秒）

* cache_prefix

    データキーの接頭辞

必要ライブラリ/モジュール
----
- [memecached](http://memcached.org/)
- [Memcache (PHP extension)](http://php.net/manual/ja/book.memcached.php)

テスト
-----
ベースディレクトリで以下のコマンドを実行すると、phpunitのテストケースが流れます。

    phpunit --stderr --bootstrap tests/bootstrap.php tests/tests.php

ライセンス
----
Copyright (c) 2012 Hiroki Tanaka

The MIT License (MIT) [http://www.opensource.org/licenses/MIT](http://www.opensource.org/licenses/MIT)