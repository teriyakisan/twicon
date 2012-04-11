<?php
/**
 * twicon test
 * --
 * need phpunit
 * https://github.com/sebastianbergmann/phpunit
 *
 * @version 1.0
 * @author  Hiroki Tanaka
 * @license The MIT License (MIT) http://www.opensource.org/licenses/MIT
 * @copyright Copyright (C) 2012 Hiroki Tanaka.
 */
class twiconTestCase extends PHPUnit_Framework_TestCase {

    const TEST_TWITTER_ID = 783214;

    const TEST_TWITTER_ICON_URL_ORIGINAL = 'http://a0.twimg.com/profile_images/1124040897/at-twitter.png';
    const TEST_TWITTER_ICON_URL_MINI     = 'http://a0.twimg.com/profile_images/1124040897/at-twitter_mini.png';
    const TEST_TWITTER_ICON_URL_NORMAL   = 'http://a0.twimg.com/profile_images/1124040897/at-twitter_normal.png';
    const TEST_TWITTER_ICON_URL_BIGGER   = 'http://a0.twimg.com/profile_images/1124040897/at-twitter_bigger.png';

    const TEST_TWITTER_ICON_URL_ORIGINAL_SSL = 'https://si0.twimg.com/profile_images/1124040897/at-twitter.png';
    const TEST_TWITTER_ICON_URL_MINI_SSL     = 'https://si0.twimg.com/profile_images/1124040897/at-twitter_mini.png';
    const TEST_TWITTER_ICON_URL_NORMAL_SSL   = 'https://si0.twimg.com/profile_images/1124040897/at-twitter_normal.png';
    const TEST_TWITTER_ICON_URL_BIGGER_SSL   = 'https://si0.twimg.com/profile_images/1124040897/at-twitter_bigger.png';

    public function testConnectMemcache()
    {
        $twicon = new Twicon();
        $this->assertTrue($twicon->getMemcachedStatus(), 'failed to connect memcached server');
    }

    public function testGetIconUrlNoTargetSize()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_ORIGINAL, $twicon->getIconUrl(self::TEST_TWITTER_ID));
    }

    public function testGetIconUrlOriginal()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_ORIGINAL, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_ORIGINAL));
    }

    public function testGetIconUrlMini()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_MINI, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_MINI));
    }

    public function testGetIconUrlNormal()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_NORMAL, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_NORMAL));
    }

    public function testGetIconUrlBigger()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_BIGGER, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_BIGGER));
    }

    public function testGetIconUrlNoTargetSizeSsl()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_ORIGINAL_SSL, $twicon->getIconUrl(self::TEST_TWITTER_ID, null, true));
    }

    public function testGetIconUrlOriginalSsl()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_ORIGINAL_SSL, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_ORIGINAL, true));
    }

    public function testGetIconUrlMiniSsl()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_MINI_SSL, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_MINI, true));
    }

    public function testGetIconUrlNormalSsl()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_NORMAL_SSL, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_NORMAL, true));
    }

    public function testGetIconUrlBiggerSsl()
    {
        $twicon = new Twicon();
        $this->assertEquals(self::TEST_TWITTER_ICON_URL_BIGGER_SSL, $twicon->getIconUrl(self::TEST_TWITTER_ID, Twicon::SIZE_BIGGER, true));
    }
}