<?php
/**
 * Example: embed url in image source
 * --
 * You would embed url in image source
 *
 */
require dirname(dirname(__FILE__)) . '/src/twicon.php';
$id = 783214; // ex) http://twitter.com/twitter
$size = Twicon::SIZE_ORIGINAL;
$twicon = new Twicon();
$src = $twicon->getIconUrl($id, $size);
if (!$src) {
    $src = 'data:image/gif;base64,' . twicon::DUMMY_GIF_BINARY;
}
echo '<img src="' . $src . '" alt="" />';