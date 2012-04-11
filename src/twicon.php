<?php
/**
 * twicon
 * --
 * get & caache twitter icon image path
 *
 * @version 1.0
 * @author  Hiroki Tanaka
 * @license The MIT License (MIT) http://www.opensource.org/licenses/MIT
 * @copyright Copyright (C) 2012 Hiroki Tanaka.
 */
class Twicon
{
    const TW_API_URL       = 'http://api.twitter.com/';
    const DUMMY_GIF_BINARY = 'R0lGODlhAQABAIAAAP///wAAACH5BAHoAwAALAAAAAABAAEAAAICRAEAOw==';

    const SIZE_ORIGINAL = 0;
    const SIZE_MINI     = 1;
    const SIZE_NORMAL   = 2;
    const SIZE_BIGGER   = 3;

    private $config = array(
        'host' => 'localhost',
        'port' => 11211,
        'cache_expire_sec' => 21600, // 6h
        'cache_prefix' => 'twicon_', // memcached key prefix
    );
    private $sizes = array(
        0 => '', // original
        1 => '_mini', // mini
        2 => '_normal', // normal
        3 => '_bigger' // bigger
    );
    private $memcache = null;

    public function __construct()
    {
        $file = dirname(dirname(__FILE__)) . '/config/memcached.ini';
        if (file_exists($file)) {
            $config = parse_ini_file($file, true);
        }
        if (!empty($config['memcached'])) {
            $this->config = array_merge($this->config, $config['memcached']);
        }
        $this->memcache = new Memcache();
        $this->memcache->connect($this->config['host'], $this->config['port']);
    }

    /**
     * redirect to icon
     *
     * @return void
     */
    public function out($id, $size = 0)
    {
        if (isset($id) && is_numeric($id)) {
            // return url
            if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $url = $this->getIconUrl($id, $size, true);
            } else {
                $url = $this->getIconUrl($id, $size);
            }
            if ($url !== false) {
                // redirect pure twitter icon url
                header('HTTP/1.1 302 Moved Temporarily');
                header('Location: ' . $url);
                return;
            }
        }
        // if not get url, output 1px x 1px gif
        header("Content-Type: Content-type: image/gif");
        echo base64_decode(self::DUMMY_GIF_BINARY);
    }

    /**
     * get icon url
     *
     * @param  int $id
     * @param  string $size
     * @return mixed string or false
     */
    public function getIconUrl($id, $size = 0, $sslFlg = false)
    {
        if (!is_numeric($id)) {
            return false;
        }
        if (!array_key_exists($size, $this->sizes)) {
            $size = 0; // original
        }

        // get last data
        if ($this->getMemcachedStatus()) {
            $data = $this->memcache->get($this->config['cache_prefix'] . $id);
        }
        if (empty($data['http']) || empty($data['https'])) {
            // get latest data
            $json = @file_get_contents(self::TW_API_URL . '1/users/lookup.json?user_id=' . $id);
            $twData = json_decode($json);
            if (!empty($twData[0]->profile_image_url) && !empty($twData[0]->profile_image_url_https)) {
                $data = array(
                    'http' => str_replace('_normal', '#SIZE#', $twData[0]->profile_image_url),
                    'https' => str_replace('_normal', '#SIZE#', $twData[0]->profile_image_url_https)
                );
                $this->memcache->set($this->config['cache_prefix'] . $id , $data, false, $this->config['cache_expire_sec']);
            } else {
                return false;
            }
        }

        // return url
        if ($sslFlg) {
            return str_replace('#SIZE#', $this->sizes[$size], $data['https']);
        } else {
            return str_replace('#SIZE#', $this->sizes[$size], $data['http']);
        }
    }

    /**
     * get memcache status
     *
     * @return bool
     */
    public function getMemcachedStatus()
    {
        if (!is_null($this->memcache)) {
            return $this->memcache->getServerStatus($this->config['host'], $this->config['port']) ? true : false;
        }
        return false;
    }
}