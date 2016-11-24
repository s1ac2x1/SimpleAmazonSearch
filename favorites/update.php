<?php
require_once(dirname(__FILE__) . "/../core/Search.php");
require_once(dirname(__FILE__) . "/../html/BaseSearchHTML.php");

$asin = $_POST['asin'];
$fb_id = $_POST['fb_id'];
$divCount = $_POST['div_count'];
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
if ($fb_id && $asin) {
    $search = new Search($accessKeyID, $trackingID, $secretAccessKey);
    $xml = $search->loadItemRawXML($asin);
    $item = $xml->Items->Item;
    if ($item) {
        $error = 0;
        $base = new BaseSearchHTML(null, null);
        $itemInfo = $base->getItemInfo($item);
        $splittedContent = explode("***", $itemInfo);
        $title = explode("&&&", $splittedContent[12]);
        $smallImageURL = explode("&&&", $splittedContent[27]);
        $smallImageH = explode("&&&", $splittedContent[28]);
        $smallImageW = explode("&&&", $splittedContent[29]);
        $minimunPrice = explode("&&&", $splittedContent[1]);
        $price = base64_decode($minimunPrice[1]);
        include("../db.php");
        $db->query("UPDATE favorites SET price = $price, error = $error, title = '" . $title[1] . "', small_img_url = '$smallImageURL[1]', date = now(), img_height = '" . base64_decode($smallImageH[1]) . "', img_width = '" . base64_decode($smallImageW[1]) . "', deleted = 0, content = '$itemInfo' WHERE asin = '$asin' AND fb_id = $fb_id");
        $db = null;
        $top = 40 - (base64_decode($smallImageH[1]) / 2);
        $left = (base64_decode($smallImageW[1]) / 25) - 2;
        $price_ = "$" . number_format($price / 100, 0, '.', ',');
        $tip = "<center><font style=\"font-family: georgia, serif;font-size: 18pt; font-weight:bold;\">" . $price_ . "</font><br><font style=\"font-family: georgia, serif;font-size: 14pt;\">" . base64_decode($title[1]) . "</font></center>";
        echo "<span style=\"display:none;\" id=\"fav-update-result\">good</span><span onmouseover=\"favOver('" . base64_encode($tip) . "');\" onmouseout=\"favOut();\" onclick=\"loadFav('" . $asin . "');\" style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src='" . base64_decode($smallImageURL[1]) . "'></span><div style=\"cursor:pointer;position:absolute;top:2px;right:2px;\" onmouseover=\"favRemOver('" . $title[1] . "');\" onmouseout=\"$('#fav-hint').html('');\" onclick=\"remFavFromImg('" . $asin . "', '" . $ifb_id . "', '" . $title[1] . "', $divCount);\"><img src=\"img/remfav.png\"></div>";
    } else {
        include("../db.php");
        $error = 1;
        $title = "VGhpcyBpdGVtIGhhcyBiZWVuIGRlbGV0ZWQgaW4gQW1hem9uIHN0b3Jl";
        $title2 = "";
        $smallImageURL = base64_encode("http://simpleamazonsearch.com/img/nofav.png");
        $smallImageH = 64;
        $smallImageW = 64;
        $top = 40 - ($smallImageH / 2);
        $left = ($smallImageW / 25) - 2;

        $items = array();
        $originTitle = $db->query("SELECT title FROM favorites WHERE fb_id = $fb_id AND asin = '$asin'")->fetchColumn();
        $content = "<div id=\"error-item\" style=\"display:none;\">1</div><span class=\"error-item\">This item has been deleted or changed in Amazon. Let's try to <span class=\"example-search\" onclick=\"reFind('" . $originTitle . "');\">find it</span> again</span>";

        $db->query("UPDATE favorites SET error = $error, small_img_url = '$smallImageURL', date = now(), img_height = '" . $smallImageH . "', img_width = '" . $smallImageW . "', deleted = 0, content = '" . base64_encode($content) . "' WHERE asin = '$asin' AND fb_id = $fb_id");
        $db = null;
        echo "<span style=\"display:none;\" id=\"fav-update-result\">bad</span><span style=\"display:none;\" id=\"fav-update-result-title\">" . $originTitle . "</span><span style=\"display:none;\">bad</span><span onmouseover=\"favOver('" . $title . "');\" onmouseout=\"$('#fav-hint').html('');\" style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src='" . base64_decode($smallImageURL) . "'></span><div style=\"cursor:pointer;position:absolute;top:2px;right:2px;\" onmouseover=\"favRemOver('" . $title2 . "');\" onmouseout=\"$('#fav-hint').html('');\" onclick=\"remFavFromImg('" . $asin . "', '" . $ifb_id . "', '" . $title2 . "', $divCount);\"><img src=\"img/remfav.png\"></div>";
    }

}

?>
