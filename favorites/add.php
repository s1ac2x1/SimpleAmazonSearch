<?php
require_once(dirname(__FILE__) . "/../core/Search.php");
require_once(dirname(__FILE__) . "/../html/BaseSearchHTML.php");

$fb_id = $_POST['fb_id'];
$asin = $_POST['asin'];
$title = $_POST['title'];
$imgUrl = $_POST['imgUrl'];
$imgHeight = $_POST['img_height'];
$imgWidth = $_POST['img_width'];
$cacheFileUrl = $_POST['cacheFileUrl'];
$accessKeyID = $_POST['accessKeyID'];
$secretAccessKey = $_POST['secretAccessKey'];
$trackingID = $_POST['trackingID'];

$accessKeyID = trim($accessKeyID);
$secretAccessKey = trim($secretAccessKey);
$trackingID = trim($trackingID);

if ($accessKeyID == 'undefined' || $accessKeyID == "") {
    $accessKeyID = null;
}
if ($secretAccessKey == 'undefined' || $secretAccessKey == "") {
    $secretAccessKey = null;
}
if ($trackingID == 'undefined' || $trackingID == "") {
    $trackingID = null;
}
if ($fb_id && $asin && $title && $imgUrl && $imgHeight && $imgWidth && $cacheFileUrl) {
    if ($cacheFileUrl != "/") {
        $cacheContent = file_get_contents(dirname(__FILE__) . "/../cache/" . $cacheFileUrl);
    } else {
        $search = new Search($accessKeyID, $trackingID, $secretAccessKey);
        $xml = $search->loadItemRawXML($asin);
        $item = $xml->Items->Item;
        if ($item) {
            $base = new BaseSearchHTML(null, null);
            $itemInfo = $base->getItemInfo($item);
            $cacheContent = $itemInfo;
        }
    }

    $splittedContent = explode("***", $cacheContent);
    $minimunPrice = explode("&&&", $splittedContent[1]);
    $price = base64_decode($minimunPrice[1]);

    include("../db.php");
    $num = $db->query("SELECT count(*) as num FROM favorites WHERE fb_id = $fb_id AND asin = '$asin'")->fetchColumn();

    if ($num > 0) {
        $db->query("UPDATE favorites SET price = $price, title = '$title', small_img_url = '$imgUrl', date = now(), img_height = '$imgHeight', img_width = '$imgWidth', deleted = 0, content = '$cacheContent', error = 0 WHERE asin = '$asin' AND fb_id = $fb_id");
    } else {
        $db->query("INSERT INTO favorites (asin, title, small_img_url, date, fb_id, img_height, img_width, content, price) VALUES ('$asin', '$title', '$imgUrl', now(), $fb_id, $imgHeight, $imgWidth, '$cacheContent', $price)");
    }
    $db = null;
}
?>
