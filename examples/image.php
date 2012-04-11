<?php
/**
 * Example: redirect directly
 * --
 * You would direct redirect
 * ex) <img src="image.php?id=783214" alt="" />
 *
 */
require dirname(dirname(__FILE__)) . '/src/twicon.php';
$twicon = new Twicon();
$twicon->out(htmlspecialchars($_GET['id'], ENT_QUOTES), htmlspecialchars($_GET['size'], ENT_QUOTES));