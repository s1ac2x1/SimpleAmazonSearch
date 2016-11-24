<?php
require_once(dirname(__FILE__) . "/../core/Search.php");

$path = $_GET['path'];
$type = $_GET['type'];

function encodeString($input)
{
    foreach (str_split($input) as $obj) {
        $output .= '&#' . ord($obj) . ';';
    }
    return $output;
}


if ($type == 'link') {
    $cachedFileContent = file_get_contents(dirname(__FILE__) . "/../links/" . $path);
    $arr = explode("***", $cachedFileContent);
    $link = $arr[2];
    $fb_id = $arr[0];
    header("Location: " . $link);
}
if ($type == 'keyword') {
    $key = file_get_contents(dirname(__FILE__) . "/../search/" . $path);
    header("Location: http://simpleamazonsearch.com/index.php?key=" . $key);
}
if ($type == 'asin') {
    header("Location: http://www.amazon.com/dp/" . $path . "/?tag=manualsoblog-20");
}
?>
