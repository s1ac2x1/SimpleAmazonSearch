<?php
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

$params = $_POST['files'];
$folder = $_POST['folder'];
$debug = $_POST['debug'];
$mode = $_POST['mode'];
$sort = $_POST['sort'];
$filePaths = explode(";", $params);
$TDs = "";
$counter = 1;

if ($folder == 'base_search') {
    $jsShowFnName = "show";
    $jsMouseOverFnName = "itemMouseOver";
    $jsMouseOutFnName = "itemMouseOut";
    $divId = "img-inside-inline-rectangle-";
    $divIdLoader = "img-inside-inline-rectangle-loader-";
    $itemDivIdPrefix = "lbi";
    $divType = "baseSearch";
}
if ($folder == 'index_search') {
    $jsShowFnName = "showIndexItem";
    $jsMouseOverFnName = "itemMouseOverIndexItem";
    $jsMouseOutFnName = "itemMouseOutIndexItem";
    $divId = "right-menu-item-";
    $itemDivIdPrefix = "ilbi";
    $divType = "indexSearch";
}


$debugInfo = "<ul>";

function get_bitly_short_url($url, $login = 's1ac2x1', $appkey = 'R_0051c726eb134a5e28329106ea675d77', $format = 'txt')
{
    $connectURL = 'http://api.bit.ly/v3/shorten?login=' . $login . '&apiKey=' . $appkey . '&uri=' . urlencode($url) . '&format=' . $format;
    return curl_get_result($connectURL);
}

function curl_get_result($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

class TableItem
{
    public $asin;
    public $minimunPrice;
    public $mediumImageURL;
    public $mediumImageHeight;
    public $mediumImageWidth;
    public $bigImageURL;
    public $binding;
    public $bigImageHeight;
    public $bigImageWidth;
    public $price;
    public $rawPrice;
    public $datailsLink;
    public $review;
    public $title;
    public $bnTitle;
    public $offersCount;
    public $cacheFilePath;
}

function sortItemsByPrice($item1, $item2)
{
    if ($item1->minimunPrice == $item2->minimunPrice) {
        return 0;
    }
    return ($item1->minimunPrice < $item2->minimunPrice) ? -1 : 1;
}

function sortItemsByOffers($item1, $item2)
{
    if ($item1->offersCount == $item2->offersCount) {
        return 0;
    }
    return ($item1->offersCount < $item2->offersCount) ? -1 : 1;
}

$tableItems = array();

foreach ($filePaths as $path) {
    $content = file_get_contents(dirname(__FILE__) . "/../cache/" . $folder . "/" . $path);
    $splittedContent = explode("***", $content);
    $tableItem = new TableItem();

    $tableItem->cacheFilePath = $path;
    $tableItem->asin = explode("&&&", $splittedContent[0]);
    $price_ = explode("&&&", $splittedContent[1]);
    $tableItem->minimunPrice = base64_decode($price_[1]);
    $tableItem->mediumImageURL = explode("&&&", $splittedContent[2]);
    $tableItem->mediumImageHeight = explode("&&&", $splittedContent[3]);
    $tableItem->mediumImageWidth = explode("&&&", $splittedContent[4]);
    $tableItem->bigImageURL = explode("&&&", $splittedContent[5]);
    $tableItem->binding = explode("&&&", $splittedContent[24]);
    $tableItem->bigImageHeight = explode("&&&", $splittedContent[25]);
    $tableItem->bigImageWidth = explode("&&&", $splittedContent[26]);
    $tableItem->datailsLink = explode("&&&", $splittedContent[13]);
    $tableItem->review = explode("&&&", $splittedContent[7]);
    $tableItem->title = explode("&&&", $splittedContent[12]);
    $tableItem->bnTitle = explode("&&&", $splittedContent[30]);

    $tableItem->offersCount = 0;

    $offersNew = explode("&&&", $splittedContent[9]);
    $offersUsed = explode("&&&", $splittedContent[10]);
    $offersRefurbished = explode("&&&", $splittedContent[11]);

    if ($offersNew[1] && intval(base64_decode($offersNew[1])) > 0) {
        $tableItem->offersCount += intval(base64_decode($offersNew[1]));
    }
    if ($offersUsed[1] && intval(base64_decode($offersUsed[1])) > 0) {
        $tableItem->offersCount += intval(base64_decode($offersUsed[1]));
    }
    if ($offersRefurbished[1] && intval(base64_decode($offersRefurbished[1])) > 0) {
        $tableItem->offersCount += intval(base64_decode($offersRefurbished[1]));
    }

    array_push($tableItems, $tableItem);
}

if ($sort == 'price') {
    usort($tableItems, "sortItemsByPrice");
}
if ($sort == 'offers') {
    usort($tableItems, "sortItemsByOffers");
}

if ($mode == 'default') {
    $itemClass = "left-base-items";
    $showAdditionalParameter = "";

    if ($sort == 'price') {
        $firstTitle = "<div id='first-items-part-price' style='border: 1px solid #346789;box-shadow: 2px 2px 19px #e0e0e0;-o-box-shadow: 2px 2px 19px #e0e0e0;-webkit-box-shadow: 2px 2px 19px #e0e0e0;-moz-box-shadow: 2px 2px 19px #e0e0e0;-moz-border-radius: 0.5em;border-radius: 0.5em;background-color:rgb(194,252,194);padding-bottom:20px;width:80%;'><span style='font-family: arial, serif; color: black; font-size: 15pt; font-weight: bold;margin:10px;'>The cheapest</span>";
    }
    if ($sort == 'offers') {
        $firstTitle = "<div id='first-items-part-offers' style='border: 1px solid #346789;box-shadow: 2px 2px 19px #e0e0e0;-o-box-shadow: 2px 2px 19px #e0e0e0;-webkit-box-shadow: 2px 2px 19px #e0e0e0;-moz-box-shadow: 2px 2px 19px #e0e0e0;-moz-border-radius: 0.5em;border-radius: 0.5em;background-color:rgb(252,209,228);padding-bottom:20px;width:80%;'><span style='font-family: arial, serif; color: black; font-size: 15pt; font-weight: bold;margin:10px;'>Less offers</span>";
    }
    $itemsTable = $firstTitle . "<br><table><tr>";
}
if ($mode == 'big') {
    $itemClass = "left-base-items-big";
    $showAdditionalParameter = ", 'big'";
    $itemsTable = "<div id=\"items-big-pictures\" style=\"width:85%;overflow:auto;\"><table id=\"big-items-table\"><tr>";
    include("../db.php");
}

$totalOffersCount = 0;

$half = round(count($tableItems) / 2);

foreach ($tableItems as $tableItem) {
    $offersCount = $tableItem->offersCount;
    $totalOffersCount += $offersCount;
    $asin = $tableItem->asin[1];
    $minimunPrice = $tableItem->minimunPrice;
    $mediumImageURL = $tableItem->mediumImageURL[1];
    $mediumImageHeight = $tableItem->mediumImageHeight[1];
    $mediumImageWidth = $tableItem->mediumImageWidth[1];
    $bigImageURL = $tableItem->bigImageURL[1];
    $binding = $tableItem->binding[1];
    if ($mode == 'default') {
        $top = 90 - (base64_decode($mediumImageHeight) / 2);
        $left = (base64_decode($mediumImageWidth) / 25) - 6;
    }
    $bigImageHeight = $tableItem->bigImageHeight[1];
    $bigImageWidth = $tableItem->bigImageWidth[1];
    if ($mode == 'big') {
        $top = 250 - (base64_decode($bigImageHeight) / 2);
        $left = (base64_decode($bigImageWidth) / 25) - 15;
    }
    $price = "$" . number_format($minimunPrice / 100, 2, '.', ',');
    $price = str_replace(".00", "", $price);
    $datailsLink = $tableItem->datailsLink[1];
    $review = $tableItem->review[1];
    $title = $tableItem->title[1];
    $titleDecoded_ = base64_decode($title);
    $titleDecoded = "";
    if (strlen($titleDecoded_) > 55) {
        $titleDecoded = substr($titleDecoded_, 0, 55);
        $titleDecoded .= "...";
    } else {
        $titleDecoded = $titleDecoded_;
    }

    $itemTip = "<center><font style=\"font-family: georgia, serif;font-size: 18pt; font-weight:bold;\">$price</font><br><font style=\"font-family: georgia, serif;font-size: 14pt;\">$titleDecoded</font></center>";

    if (base64_decode($mediumImageURL)) {
        if ($mode == "default") {
            $imageURL = base64_decode($mediumImageURL);
        }
        if ($mode == "big") {
            $imageURL = base64_decode($bigImageURL);
        }
    } else {
        $imageURL = "img/noimage.gif";
        $top = 15;
        $left = 2;
    }

    if ($mode != 'big') {
        $priceInfo = "
			<div class=\"big-img-quickinfo-div\" id=\"big-img-quickinfo-div-$counter\" style=\"position:absolute; top:3px; left:5px; text-align:center; height: 30px; width: 50%;display:none;\">
				<center><span style=\"position:absolute;top:-28px;left:3px;font-family: georgia, serif;font-size: 14pt;\"><b>$price</b></span></center>
			</div>";
        $offersInfo = "
			<div class=\"big-img-offers-div\" id=\"small-img-offers-div-$counter\" style=\"position:absolute; bottom:3px; left:5px; text-align:center; height: 30px; width: 50%;display:none;\">
				<center><span style=\"position:absolute;top:-26px;left:3px;font-family: georgia, serif;font-size: 14pt;\"><b>$offersCount offers</b></span></center>
			</div>";
    }

    if ($mode == 'big') {
        $shortLinkImageString = $title . "@@@" . $price . "@@@" . $datailsLink . "@@@" . $bigImageURL;
        $shortenedLinkImage = "";

        foreach ($db->query("SELECT id, count(*) as num FROM links WHERE info = '$shortLinkImageString' AND type = 'image'") as $row) {
            $num = $row['num'];
            $shortLinkId = $row['id'];
        }

        if ($num > 0) {
            $shortenedLinkImage = base_convert($shortLinkId, 10, 36);
        } else {
            $db->exec("INSERT INTO links (type, info) VALUES ('image', '$shortLinkImageString')");
            $shortenedLinkImage = base_convert($db->lastInsertId(), 10, 36);
        }

        $bitLy = get_bitly_short_url("http://simpleamazonsearch.com/photo-" . $shortenedLinkImage);


        $q = null;

        $bnTitle = $tableItem->bnTitle[1];

        $bigImageSharer = "
			<div class=\"big-img-share-div\" id=\"big-img-share-div-$counter\" style=\"position:absolute;bottom:6px;left:3px;height:50px;display:none;\">
				<div style=\"position:relative;top:-14px;height:50px;\">
					Share image:&nbsp;
					<span style=\"position:relative;top:8px;\">
						<a href=\"http://www.facebook.com/sharer.php?u=http://simpleamazonsearch.com/photo-$shortenedLinkImage\" target=\"_blank\"><img border=\"0\" src=\"img/fb-share.png\"></a>&nbsp;
						<a href=\"http://twitter.com/home?status=Great " . base64_decode($bnTitle) . ": $bitLy\" target=\"_blank\"><img border=\"0\" src=\"img/twitter.png\"></a>
					</span>&nbsp;
					<input type=\"test\" size=\"20\" value=\"$bitLy\" onclick=\"this.select();\">
				</div>
			</div>";

        $quickInfo = "
			<div class=\"big-img-quickinfo-div\" id=\"big-img-quickinfo-div-$counter\" style=\"position:absolute;top:6px;left:3px;height:50px;width:98%;display:none;\">
				<span style=\"position:absolute;top:-28px;left:3px;font-family: georgia, serif;font-size: 14pt;\"><b>$price</b></span>
				<br>
				<span style=\"position:absolute;top:-5px;left:3px;font-family: georgia, serif;font-size: 12pt;\">$titleDecoded</span>
			</div>";

        $offers = "
			<div class=\"big-img-offers-div\" id=\"big-img-offers-div-$counter\" style=\"position:absolute;top:65px;left:3px;height:50px;width:50%;display:none;\">
				<span style=\"position:absolute;top:-18px;left:3px;font-family: georgia, serif;font-size: 14pt;\"><b>$offersCount offers</b></span>
			</div>";

        $titleForSiteMap = str_replace('"', "", base64_decode($title));
        $titleForSiteMap = str_replace("'", "", $titleForSiteMap);
        $titleForSiteMap = str_replace("&", "and", $titleForSiteMap);
        $titleForSiteMap = preg_replace('/[^a-zA-Z0-9_ %\[\]\.,\(\)%&-]/s', '', $titleForSiteMap);
        $titleForSiteMap = str_replace(" ", "-", $titleForSiteMap);
        $titleForSiteMap = str_replace(".", "-", $titleForSiteMap);
        $titleForSiteMap = str_replace("(", "", $titleForSiteMap);
        $titleForSiteMap = str_replace(")", "", $titleForSiteMap);
        $titleForSiteMap = str_replace("[", "", $titleForSiteMap);
        $titleForSiteMap = str_replace("]", "", $titleForSiteMap);
        $titleForSiteMap = str_replace("{", "", $titleForSiteMap);
        $titleForSiteMap = str_replace("}", "", $titleForSiteMap);
        if (strlen($titleForSiteMap) > 150) {
            $titleForSiteMap = substr($titleForSiteMap, 0, 150);
        }

        $shortLinkSitemapInfoString = $title . "@@@" . $price . "@@@" . $datailsLink . "@@@" . $bigImageURL . "@@@" . $review;
        $shortenedLink = "";

        $num = $db->query("SELECT COUNT(*) c FROM sitemap_offers WHERE type='item' AND url = '$titleForSiteMap'")->fetchColumn();

        if ($num <= 0) {
            $db->exec("INSERT INTO sitemap_offers (type, info, url) VALUES ('item', '$shortLinkSitemapInfoString', '$titleForSiteMap')");
        }


    }

    $itemsTable .= "
		<td valign=\"top\">
			<div id=\"item-" . $counter . "-asin\" style=\"display: none;\">" . base64_decode($asin) . "</div>
			<div id=\"item-" . $counter . "-cached-file\" style=\"display: none;\">" . $tableItem->cacheFilePath . "</div>
			<div id=\"item-" . $counter . "-tip-$divType\" style=\"display: none;\">" . $itemTip . "</div>
			<div class=\"left-base-items-outer\" style=\"position:relative;\" onclick=\"" . $jsShowFnName . "(this, " . $counter . ", null" . $showAdditionalParameter . ");\">
				<div class=\"$itemClass\" id=\"" . $itemDivIdPrefix . "-" . $counter . "\" onmouseover=\"$('#small-img-offers-div-$counter').show();$('#big-img-share-div-$counter').show();$('#big-img-quickinfo-div-$counter').show();$('#big-img-offers-div-$counter').show();\" onmouseout=\"$('#big-img-share-div-$counter').hide();$('#big-img-quickinfo-div-$counter').hide();$('#big-img-offers-div-$counter').hide();$('#small-img-offers-div-$counter').hide();\">
					<div id=\"" . $divId . $counter . "\" style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\">
								<img id=\"item" . $counter . "-img\" src=\"" . $imageURL . "\">
					</div>$bigImageSharer $quickInfo $offers $priceInfo $offersInfo
				</div>				
			</div>
		</td>";
    if ($debug == 'on') {
        $debugInfo .= "<li>ASIN=" . base64_decode($asin) . ", minimunPrice=" . $minimunPrice . ", mediumImageURL=" . base64_decode($mediumImageURL) . ", mediumImageHeight=" . base64_decode($mediumImageHeight) . ", mediumImageWidth=" . base64_decode($mediumImageWidth) . ", binding=" . base64_decode($binding) . "<br>bigImageURL=" . base64_decode($bigImageURL) . "</li>";
    }
    $counter++;
    if ($mode == 'default' && $counter == $half) {
        if ($sort == 'price') {
            $secondTitle = "<div id='first-items-part-price' style='border: 1px solid #346789;box-shadow: 2px 2px 19px #e0e0e0;-o-box-shadow: 2px 2px 19px #e0e0e0;-webkit-box-shadow: 2px 2px 19px #e0e0e0;-moz-box-shadow: 2px 2px 19px #e0e0e0;-moz-border-radius: 0.5em;border-radius: 0.5em;background-color:rgb(252,209,228);padding-bottom:20px;width:80%;'><span style='font-family: arial, serif; color: black; font-size: 15pt; font-weight: bold;margin:10px;'>More expensive</span>";
        }
        if ($sort == 'offers') {
            $secondTitle = "<div id='first-items-part-offers' style='border: 1px solid #346789;box-shadow: 2px 2px 19px #e0e0e0;-o-box-shadow: 2px 2px 19px #e0e0e0;-webkit-box-shadow: 2px 2px 19px #e0e0e0;-moz-box-shadow: 2px 2px 19px #e0e0e0;-moz-border-radius: 0.5em;border-radius: 0.5em;background-color:rgb(194,252,194);padding-bottom:20px;width:80%;'><span style='font-family: arial, serif; color: black; font-size: 15pt; font-weight: bold;margin:10px;'>More offers</span>";
        }
        $itemsTable .= "</tr></table></div>$secondTitle<table><tr>";
    }
}

if ($mode == 'default') {
    $itemsTable .= "</tr></table></div>";
}
if ($mode == 'big') {
    $itemsTable .= "</tr></table></div>";
    $db = null;
}
$debugInfo .= "</ul>";
$baseSearchPattern = file_get_contents(dirname(__FILE__) . "/../patterns/base_search_items.pattern");
$baseSearchPattern = str_replace("###items###", $itemsTable, $baseSearchPattern);
if ($debug == 'on') {
    $baseSearchPattern = str_replace("###debug.info###", $debugInfo, $baseSearchPattern);
} else {
    $baseSearchPattern = str_replace("###debug.info###", "", $baseSearchPattern);
}
echo $baseSearchPattern . "<div id=\"total-offers-count\" style=\"display:none;\">$totalOffersCount</div>";
?>