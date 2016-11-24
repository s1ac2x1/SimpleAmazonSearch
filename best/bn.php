<?php
require_once(dirname(__FILE__) . "/../core/Search.php");
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

function generateLink($srcLink, $folder, $date, $fb_id, $type, $asin, $conf)
{
    $micro = microtime();
    $t = str_replace(" ", "", $micro);
    $t = str_replace(".", "", $t);
    $uuid = CacheHelper::gen_uuid();
    $uuid = str_replace("-", "", $uuid);
    $uniq = $t . $uuid;
    if (!is_dir(dirname(__FILE__) . "/../links/" . $date)) {
        mkdir(dirname(__FILE__) . "/../links/" . $date);
    }
    $fh = fopen(dirname(__FILE__) . "/../links/" . $date . "/" . $uniq, "a");
    fwrite($fh, $fb_id . "***" . $type . "***" . $srcLink . "***" . $asin);
    fclose($fh);
    return $conf['siteURL'] . "/" . $folder . "/" . $date . "/" . $uniq;
}

$id = $_POST['id'];
$fb_id = $_POST['fb_id'];
$divId = $_POST['div_id'];
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

if ($id && $fb_id && $divId) {
    date_default_timezone_set('Europe/Kiev');
    $conf = parse_ini_file(dirname(__FILE__) . "/../conf.ini");
    $currDate = date("d-m-Y_H-i");
    $search = new Search($accessKeyID, $trackingID, $secretAccessKey);
    $xml = $search->loadTopSellersRawXML($id);
    if ($xml == 'limit') {
        header($_SERVER['SERVER_PROTOCOL'] . ' Limit', true, 500);
    } else {
        $result = "<br><table style=\"float:left; width:100%\" class=\"bn-table\">";
        $bnTitle = $xml->BrowseNodes->BrowseNode->Name;
        foreach ($xml->BrowseNodes->BrowseNode->TopItemSet->TopItem as $item) {
            $title = $item->Title;
            $title = str_replace('"', "", $title);
            $title = str_replace("'", "", $title);
            $title = preg_replace('/[^a-zA-Z0-9_ %\[\]\.,\(\)%&-]/s', '', $title);
            $result .= "<tr>";
            $result .= "<td align=\"left\" onclick=\"loadLastViewedItem('" . $item->ASIN . "', false, true);\"><span class=\"bn-items\">" . $title . "</span></td>";
            $result .= "</tr>";
        }
        $result .= "</table><br style=\"clear:both;\"><div onclick=\"closeDiv('$divId');\" style=\"cursor:pointer;position:absolute;top:2px;right:2px;\"><img src=\"img/close_tr.png\"></div>";
        echo $result;
    }
}
?>