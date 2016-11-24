<?php
require_once(dirname(__FILE__) . "/../core/Search.php");

$id = $_POST['id'];
$group = $_POST['group'];
$searchModeTitle = $_POST['searchModeTitle'];
$browseNodeFullTitleEncoded = $_POST['browseNodeFullTitleEncoded'];

$accessKeyID = $_POST['accessKeyID'];
$secretAccessKey = $_POST['secretAccessKey'];
$trackingID = $_POST['trackingID'];

$search = new Search();
$xml = $search->loadNodesRawXML($id, $group);
if ($xml == 'limit') {
    header($_SERVER['SERVER_PROTOCOL'] . ' Limit', true, 500);
} else {
    $result = "<center><span style=\"position:relative;font-size:16pt;font-family: georgia, serif;color: #2a2a2a;\">$searchModeTitle</span><br>" .
        "<span style=\"position:relative;font-size:12pt;font-family: georgia, serif;color: #2a2a2a;\">" . base64_decode($browseNodeFullTitleEncoded) . "</span></center><br>";
    if ($xml->BrowseNodes->BrowseNode->TopItemSet) {
        $result .= "<table style=\"float:left; width:100%\" class=\"bn-table\">";
        foreach ($xml->BrowseNodes->BrowseNode->TopItemSet->TopItem as $item) {

            $title = $item->Title;
            $title = str_replace('"', "", $title);
            $title = str_replace("'", "", $title);
            $title = preg_replace('/[^a-zA-Z0-9_ %\[\]\.,\(\)%&-]/s', '', $title);

            $result .= "<tr>";
            $result .= "<td align=\"left\" onclick=\"loadLastViewedItem('" . $item->ASIN . "', false, true)\"><span class=\"bn-items\">" . $title . "</span></td>";
            $result .= "</tr>";
        }
        $result .= "</table><br style=\"clear:both;\"><div onclick=\"closeDiv('nodes');\" style=\"cursor:pointer;position:absolute;top:2px;right:2px;\"><img src=\"img/close_tr.png\"></div>";
    } else {
        $result .= "<b><br><center><span style='font-size:15pt;font-family: georgia, serif;color: #2a2a2a;'>Currently no any items for that request. Sorry.<br style=\"clear:both;\"></span></center><div onclick=\"closeDiv('nodes');\" style=\"cursor:pointer;position:absolute;top:2px;right:2px;\"><img src=\"img/close_tr.png\"></div>";
    }
    echo $result;
}

?>
