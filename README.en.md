twicon
==========================

Get Twitter User Icon Image URL library written in PHP.

You can work around API limitation get the image URL via the API, because it caches to memcached.

Usage
-----
### redirect directly

```php
$twicon = new Twicon();
$twicon->out($twitterId, $size);
```

[example](http://github.com/teriyakisan/twicon/blob/master/examples/images.php)

### embed url in image source

```php
$twicon = new Twicon();
$src = $twicon->getIconUrl($id, $size);
echo '<img src="' . $src . '" alt="" />';
```

[example](http://github.com/teriyakisan/twicon/blob/master/examples/html.php)

Twicon
----
### Twicon::out

    void Twicon:out ( int $id [,int $size = 0 ] )

Reedirect pure Twitter icon URL directly.

If referer page is SSL, redirect SSL icon url.

#### Parameters

* id

    Twitter User ID

* size


    0: original
    1: mini
    2: normal
    3: bigger

#### Return Values

Returns none on success or dummy gif binary on failure.

### Twicon::getIconUrl

    mixed Twicon::getIconUrl ( int $id [,int $size = 0 [, bool $sslFlg = false ]] )

Returns Twitter icon URL string.

#### Parameters

* id

    Twitter user ID

* size

    0: original
    1: mini
    2: normal
    3: bigger

* sslFlg

    If you specify true, returns ssl url.

#### Return Values

Returns Twitter icon URL on success or FALSE on failure.

### Twicon::getMemcachedStatus

    bool Twicon::getMemcachedStatus ()

Returns connect memcached server status.

#### Return Values

Returns TRUE on success or FALSE on failure.

Configuration
----
`config/memcached.ini` is optional memcached settings file(If it's none, using default settings).

You need to write settings in `memcached` section.

* host

    memcached server host

* port

    memcached server port

* cache_expire_sec

    cache expire(second)

* cache_prefix

    data key prefix

Dependent Library / Module
----
- [memecached](http://memcached.org/)
- [Memcache (PHP extension)](http://php.net/manual/en/book.memcache.php)

Tests
-----
The tests can be executed by using this command from the base directory.

    phpunit --stderr --bootstrap tests/bootstrap.php tests/tests.php

Licence
----
Copyright (c) 2012 Hiroki Tanaka

The MIT License (MIT) [http://www.opensource.org/licenses/MIT](http://www.opensource.org/licenses/MIT)