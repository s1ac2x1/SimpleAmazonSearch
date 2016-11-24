<?php
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");
require_once(dirname(__FILE__) . "/../core/Search.php");
require_once(dirname(__FILE__) . "/../html/BaseSearchHTML.php");

date_default_timezone_set('Europe/Kiev');
$currDate = date("d-m-Y_H-i");
$conf = parse_ini_file(dirname(__FILE__) . "/../conf.ini");

function get_bitly_short_url($url, $login = '', $appkey = '', $format = 'txt')
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

function generateFindLink($asin)
{
    $conf = parse_ini_file(dirname(__FILE__) . "/../conf.ini");
    $fh = fopen(dirname(__FILE__) . "/../find/" . $asin, "a");
    fwrite($fh, "1");
    fclose($fh);
    return $conf['siteURL'] . "/find/" . $asin;
}

$filePath = $_POST['path'];
$folder = $_POST['folder'];
$fb_id = $_POST['fb_id'];
$fromDB = $_POST['db'];
$fromType = $_POST['type'];
$asinFromRequest = $_POST['asin'];
$imageType = $_POST['imageType'];

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

include("../db.php");

if ($fromDB && $asinFromRequest) {
    if ($fromType == 'fav') {
        $content = $db->query("SELECT content FROM favorites WHERE asin = '$asinFromRequest' AND fb_id = $fb_id")->fetchColumn();
        $fromFav = true;
    }
    if ($fromType == 'viewed') {
        $search = new Search($accessKeyID, $trackingID, $secretAccessKey);
        $xml = $search->loadItemRawXML($asinFromRequest);
        if ($xml == "limit") {
            header($_SERVER['SERVER_PROTOCOL'] . ' Limit', true, 500);
        }
        $item = $xml->Items->Item;
        if ($item) {
            $base = new BaseSearchHTML(null, null);
            $itemInfo = $base->getItemInfo($item);
            $content = $itemInfo;
        }
    }
} else {
    $content = @file_get_contents(dirname(__FILE__) . "/../cache/" . $folder . "/" . $filePath);
    if ($content == false) {
        echo "expired";
        return;
    }
    $fromFav = false;
}

$splittedContent = explode("***", $content);
$bigImageURL = explode("&&&", $splittedContent[5]);
$itemInfoPattern = file_get_contents(dirname(__FILE__) . "/../patterns/item_info.pattern");
$itemInfoPattern = str_replace("###big_image_url###", base64_decode($bigImageURL[1]), $itemInfoPattern);
$minimunPrice = explode("&&&", $splittedContent[1]);
$price = "$" . number_format(base64_decode($minimunPrice[1]) / 100, 2, '.', ',');
$price = str_replace(".00", "", $price);
if (base64_decode($minimunPrice[1]) == 0) {
    $price = "";
}
$itemInfoPattern = str_replace("###price###", $price, $itemInfoPattern);
$featutes = explode("&&&", $splittedContent[6]);
$featuresLi = "<ul style='margin-top:-3px;'>";
$encodedFeatures = base64_decode($featutes[1]);

$featutesArray = explode("@@@", $encodedFeatures);
if (count($featutesArray) >= 2) {
    $featuresContent = "<table width=\"100%\"><tr>";
    $middle = floor(count($featutesArray) / 2);
    $firstPart = array_slice($featutesArray, 0, $middle);
    $secondPart = array_slice($featutesArray, $middle, count($featutesArray) - 1);
    $featuresLi = "<ul>";
    foreach ($firstPart as $f) {
        if (strlen($f) > 5) {
            $featuresLi .= "<li>" . $f . "</li>";
        }
    }
    $featuresLi .= "</ul>";
    $featuresContent .= "<td valign=\"top\">" . $featuresLi . "</td>";
    $featuresLi = "<ul>";
    foreach ($secondPart as $f) {
        if (strlen($f) > 5) {
            $featuresLi .= "<li>" . $f . "</li>";
        }
    }
    $featuresLi .= "</ul>";
    $featuresContent .= "<td valign=\"top\">" . $featuresLi . "</td>";
    $featuresContent .= "</tr></table>";
} else {
    $featuresContent = "<ul>";
    foreach ($featutesArray as $f) {
        if (strlen($f) > 5) {
            $featuresContent .= "<li>" . $f . "</li>";
        }
    }
}

$review = explode("&&&", $splittedContent[7]);

if ($review[1] && $featutes[1]) {
    $reviewFeatures = "" .
        "<table><tr><td valign=\"top\" width=\"50%\">
		<div class=\"base-item-info\">
			<span class=\"links\"><div style=\"text-align:left;\" class=\"description\">" . base64_decode($review[1]) . "</div></span>
		</div></td><td valign=\"top\" width=\"50%\">
		<div class=\"base-item-info\">
			<span class=\"links\"><div style=\"text-align:left;\" class=\"description\">" . $featuresContent . "</div></span>
		</div></td></tr></table><br>";
} else if ($review[1] && !$featutes[1]) {
    $reviewFeatures = "
		<div class=\"base-item-info\">
			<span class=\"links\"><div style=\"text-align:left;\" class=\"description\">" . base64_decode($review[1]) . "</div></span>
		</div><br>";
} else if (!$review[1] && $featutes[1]) {
    $reviewFeatures = "
		<div class=\"base-item-info\">
			<span class=\"links\"><div style=\"text-align:left;\" class=\"description\">" . $featuresContent . "</div></span>
		</div><br>";
} else if (!$review[1] && !$featutes[1]) {
    $reviewFeatures = "";
}

$itemInfoPattern = str_replace("###review-features###", $reviewFeatures, $itemInfoPattern);

$offersNew = explode("&&&", $splittedContent[9]);
$offersUsed = explode("&&&", $splittedContent[10]);
$offersRefurbished = explode("&&&", $splittedContent[11]);
if (intval(base64_decode($offersNew[1])) > 0 || intval(base64_decode($offersUsed[1])) > 0 || intval(base64_decode($offersRefurbished[1])) > 0) {
    $offers = "Offers available:";
} else {
    $offers = "Look for all available offers";
}
if (intval(base64_decode($offersNew[1])) > 0) {
    $offers .= " <font style='color:green'>" . base64_decode($offersNew[1]) . " new</font>,";
}
if (intval(base64_decode($offersUsed[1])) > 0) {
    $offers .= " <font style='color:rgb(190,175,41);'>" . base64_decode($offersUsed[1]) . " used</font>,";
}
if (intval(base64_decode($offersRefurbished[1])) > 0) {
    $offers .= " <font style='color:red'>" . base64_decode($offersRefurbished[1]) . " refurbished</font>";
}
if ($offers[strlen($offers) - 1] == ',') {
    $offers = substr($offers, 0, strlen($offers) - 1);
}
$offersURL = explode("&&&", $splittedContent[8]);
$itemInfoPattern = str_replace("###offers###", "<a class=\"classname\" href=\"" . base64_decode($offersURL[1]) . "\" target=\"_blank\" style=\"text-decoration: none;display:###offers-link-display###;\">" . $offers . "</a>", $itemInfoPattern);
$title = explode("&&&", $splittedContent[12]);
$itemInfoPattern = str_replace("###title###", base64_decode($title[1]), $itemInfoPattern);
$itemInfoPattern = str_replace("###title64###", $title[1], $itemInfoPattern);
$itemInfoPattern = str_replace("###hiddentitle###", base64_decode($title[1]), $itemInfoPattern);
$datailsLink = explode("&&&", $splittedContent[13]);
$babyLink = explode("&&&", $splittedContent[14]);
$weddingLink = explode("&&&", $splittedContent[15]);
$whishlistLink = explode("&&&", $splittedContent[16]);
$friendLink = explode("&&&", $splittedContent[17]);
$custLink = explode("&&&", $splittedContent[18]);
$asin = explode("&&&", $splittedContent[0]);

$itemInfoPattern = str_replace("###link-to-short###", "http://simpleamazonsearch.com/ext-" . $title[1], $itemInfoPattern);
$itemInfoPattern = str_replace("###link-to-short-bi###", "http://simpleamazonsearch.com/img-" . $bigImageURL[1], $itemInfoPattern);

$shortLinkInfoString = $title[1] . "@@@" . $price . "@@@" . $datailsLink[1] . "@@@" . $accessKeyID . "@@@" . $secretAccessKey . "@@@" . $trackingID;
$shortenedLink = "";

foreach ($db->query("SELECT id, count(*) as num FROM links WHERE info = '$shortLinkInfoString' AND type = 'item'") as $row) {
    $num = $row['num'];
    $shortLinkId = $row['id'];
}

if ($num > 0) {
    $shortenedLink = base_convert($shortLinkId, 10, 36);
} else {
    $db->query("INSERT INTO links (type, info) VALUES ('item', '$shortLinkInfoString')");
    $shortenedLink = base_convert($db->lastInsertId(), 10, 36);
}

$bitLy = get_bitly_short_url("http://simpleamazonsearch.com/offer-" . $shortenedLink);

$itemInfoPattern = str_replace("###short-link-to-title###", $bitLy, $itemInfoPattern);
$itemInfoPattern = str_replace("###item-external-url###", $shortenedLink, $itemInfoPattern);

//

$shortLinkImageString = $title[1] . "@@@" . $price . "@@@" . $datailsLink[1] . "@@@" . $bigImageURL[1] . "@@@" . $accessKeyID . "@@@" . $secretAccessKey . "@@@" . $trackingID;
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

$itemInfoPattern = str_replace("###short-link-to-image###", $bitLy, $itemInfoPattern);
$itemInfoPattern = str_replace("###image-external-url###", $shortenedLinkImage, $itemInfoPattern);

////

$titleForSiteMap = str_replace('"', "", base64_decode($title[1]));
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

$shortLinkSitemapInfoString = $title[1] . "@@@" . $price . "@@@" . $datailsLink[1] . "@@@" . $bigImageURL[1] . "@@@" . $review[1];
$shortenedLink = "";

$num = $db->query("SELECT COUNT(*) c FROM sitemap_offers WHERE type='item' AND url = '$titleForSiteMap'")->fetchColumn();

if ($num <= 0) {
    $db->exec("INSERT INTO sitemap_offers (type, info, url) VALUES ('item', '$shortLinkSitemapInfoString', '$titleForSiteMap')");
}

////

$encodedSharedLinkURL = $bigImageURL[1];
$itemInfoPattern = str_replace("###link-to-shared-img###", $encodedSharedLinkURL, $itemInfoPattern);

$itemInfoPattern = str_replace("###details###", generateLink(base64_decode($datailsLink[1]), "links", $currDate, $fb_id, "details", base64_decode($asin[1]), $conf), $itemInfoPattern);
$itemInfoPattern = str_replace("###friend###", generateLink(base64_decode($friendLink[1]), "links", $currDate, $fb_id, "friend", base64_decode($asin[1]), $conf), $itemInfoPattern);
$itemInfoPattern = str_replace("###babyreg###", generateLink(base64_decode($babyLink[1]), "links", $currDate, $fb_id, "baby", base64_decode($asin[1]), $conf), $itemInfoPattern);
$itemInfoPattern = str_replace("###wedding###", generateLink(base64_decode($weddingLink[1]), "links", $currDate, $fb_id, "wedding", base64_decode($asin[1]), $conf), $itemInfoPattern);
$itemInfoPattern = str_replace("###wishlist###", generateLink(base64_decode($whishlistLink[1]), "links", $currDate, $fb_id, "wishlist", base64_decode($asin[1]), $conf), $itemInfoPattern);
$itemInfoPattern = str_replace("###custreview###", generateLink(base64_decode($custLink[1]), "links", $currDate, $fb_id, "review", base64_decode($asin[1]), $conf), $itemInfoPattern);

$similarASINs = explode("&&&", $splittedContent[19]);
$similarTitles = explode("&&&", $splittedContent[20]);
$similarItemsASINsArray = explode("@@@", base64_decode($similarASINs[1]));
$similarItemsTitlesArray = explode("@@@", base64_decode($similarTitles[1]));

if (count($similarItemsASINsArray) > 1) {
    $similarHTML = "<b>Similar products:</b><br><br><table>";
    $sCount = 1;
    $firstLink = generateFindLink($similarItemsASINsArray[0]);
    for ($index = 0, $max_count = count($similarItemsASINsArray); $index < $max_count; $index++) {
        $hiddenLinkDiv = "<div style=\"display:none;\" id=\"hidden-sl-$sCount\">" . generateFindLink($similarItemsASINsArray[$index]) . "</div>";
        $hiddenTitleDiv = "<div style=\"display:none;\" id=\"hidden-st-$sCount\">" . $similarItemsTitlesArray[$index] . "</div>";
        $similarHTML .= $hiddenLinkDiv;
        $similarHTML .= $hiddenTitleDiv;
        $sChecked = "";
        if ($sCount == 1) {
            $sChecked = "checked";
        }
        $similarHTML .= "<tr><td align=\"left\"><input onchange=\"simChange('$sCount');\" $sChecked type=\"radio\" class=\"simEl\" name=\"sim\" value=\"s-$sCount\" id=\"s-$sCount\">&nbsp;<label for=\"s-$sCount\" style=\"cursor:pointer;\">" . $similarItemsTitlesArray[$index] . "</label></td></tr>";
        $sCount++;
    }
    $similarHTML .= "</table><br style=\"clear:both;\"><span class=\"itemBtn\" onclick=\"findSimilar();\">Find best offers for selected item</span>&nbsp;&nbsp;<a id=\"sim-link\" href=\"" . $firstLink . "\" target=\"_blank\" class=\"itemBtn\">Open in Amazon</a>";
}

$accessoriesASINs = explode("&&&", $splittedContent[21]);
$accessoriesTitles = explode("&&&", $splittedContent[22]);
$accessoriesItemsASINsArray = explode("@@@", base64_decode($accessoriesASINs[1]));
$accessoriesItemsTitlesArray = explode("@@@", base64_decode($accessoriesTitles[1]));

if (count($accessoriesItemsASINsArray) > 1) {
    $accessoriesHTML = "<b>Best accessories:</b><br><br><table>";
    $sCount = 1;
    $firstLink = generateFindLink($accessoriesItemsASINsArray[0]);
    for ($index = 0, $max_count = count($accessoriesItemsASINsArray); $index < $max_count; $index++) {
        $hiddenLinkDiv = "<div style=\"display:none;\" id=\"hidden-al-$sCount\">" . generateFindLink($accessoriesItemsASINsArray[$index]) . "</div>";
        $hiddenTitleDiv = "<div style=\"display:none;\" id=\"hidden-at-$sCount\">" . $accessoriesItemsTitlesArray[$index] . "</div>";
        $accessoriesHTML .= $hiddenLinkDiv;
        $accessoriesHTML .= $hiddenTitleDiv;
        $sChecked = "";
        if ($sCount == 1) {
            $sChecked = "checked";
        }
        $accessoriesHTML .= "<tr><td align=\"left\"><input onchange=\"accChange('$sCount');\" $sChecked type=\"radio\" class=\"accEl\" name=\"ac\" value=\"acc-$sCount\" id=\"acc-$sCount\">&nbsp;<label for=\"acc-$sCount\" style=\"cursor:pointer;\">" . $accessoriesItemsTitlesArray[$index] . "</label></td></tr>";
        $sCount++;
    }
    $accessoriesHTML .= "</table><br style=\"clear:both;\"><span class=\"itemBtn\" onclick=\"findAcc();\">Find best offers for selected item</span>&nbsp;&nbsp;<a id=\"acc-link\" href=\"" . $firstLink . "\" target=\"_blank\" class=\"itemBtn\">Open in Amazon</a>";
}

if ($similarHTML && $accessoriesHTML) {
    $similarAccessories = "
		<table>
			<tr>
				<td valign=\"top\" width=\"49%\">
					<div class=\"base-item-info\">
						<span class=\"links\">$similarHTML</span>
					</div>		
				</td>
				<td valign=\"top\" width=\"49%\">
					<div class=\"base-item-info\">
						<span class=\"links\">$accessoriesHTML</span>
					</div>
				</td>			
			</tr>
		</table><br>";
} else if ($similarHTML && !$accessoriesHTML) {
    $similarAccessories = "
		<table>
			<tr>
				<td valign=\"top\">
					<div class=\"base-item-info\">
						<span class=\"links\">$similarHTML</span>
					</div>		
				</td>
			</tr>
		</table><br>";
} else if (!$similarHTML && $accessoriesHTML) {
    $similarAccessories = "
		<table>
			<tr>
				<td valign=\"top\">
					<div class=\"base-item-info\">
						<span class=\"links\">$accessoriesHTML</span>
					</div>
				</td>			
			</tr>
		</table><br>";
} else if (!$similarHTML && !$accessoriesHTML) {
    $similarAccessories = "";
}

$itemInfoPattern = str_replace("###similar-accessories###", $similarAccessories, $itemInfoPattern);

$parentASIN = explode("&&&", $splittedContent[23]);
$binding = explode("&&&", $splittedContent[24]);
if (base64_decode($binding[1]) == 'Apparel') {
    $itemInfoPattern = str_replace("###var-asin###", base64_decode($parentASIN[1]), $itemInfoPattern);
    $itemInfoPattern = str_replace("###var-display###", "inline", $itemInfoPattern);
} else {
    $itemInfoPattern = str_replace("###var-display###", "none", $itemInfoPattern);
}

$itemInfoPattern = str_replace("###bigImageURL###", base64_decode($bigImageURL[1]), $itemInfoPattern);

$bigImageHeight = explode("&&&", $splittedContent[25]);
$bigImageWidth = explode("&&&", $splittedContent[26]);

$itemInfoPattern = str_replace("###margin-top###", base64_decode($bigImageHeight[1]) / 2, $itemInfoPattern);
$itemInfoPattern = str_replace("###margin-left###", base64_decode($bigImageWidth[1]) / 2, $itemInfoPattern);

$top = 250 - (base64_decode($bigImageHeight[1]) / 2);
$left = 250 - (base64_decode($bigImageWidth[1]) / 2);

$itemInfoPattern = str_replace("###big-top###", $top, $itemInfoPattern);
$itemInfoPattern = str_replace("###big-left###", $left, $itemInfoPattern);

$itemInfoPattern = str_replace("###big-image-height###", base64_decode($bigImageHeight[1]) + 80, $itemInfoPattern);
$itemInfoPattern = str_replace("###big-image-width###", base64_decode($bigImageWidth[1]), $itemInfoPattern);


$currDate_ = date("d-m-Y");
if (!is_dir(dirname(__FILE__) . "/../logs/" . $currDate_)) {
    mkdir(dirname(__FILE__) . "/../logs/" . $currDate_);
}

$fh = fopen(dirname(__FILE__) . "/../logs/" . $currDate_ . "/displayed", "a");
fwrite($fh, date("H:i:s") . "***" . base64_decode($asin[1]) . "***" . base64_decode($title[1]) . "\n");
fclose($fh);

$smallImageURL = explode("&&&", $splittedContent[27]);

$itemInfoPattern = str_replace("###fav_asin###", base64_decode($asin[1]), $itemInfoPattern);
$itemInfoPattern = str_replace("###fav_title###", $title[1], $itemInfoPattern);
$itemInfoPattern = str_replace("###fav_small_img_url###", $smallImageURL[1], $itemInfoPattern);
$itemInfoPattern = str_replace("###fb_id###", $fb_id, $itemInfoPattern);

$smallImageH = explode("&&&", $splittedContent[28]);
$smallImageW = explode("&&&", $splittedContent[29]);

$itemInfoPattern = str_replace("###small_img_height###", base64_decode($smallImageH[1]), $itemInfoPattern);
$itemInfoPattern = str_replace("###small_img_width###", base64_decode($smallImageW[1]), $itemInfoPattern);

if ($fb_id > 0) {
    if (!$fromFav || $fromType == 'viewed') {
        if ($fromType == 'viewed') {
            $q = $db->query("SELECT count(*) as num, error FROM favorites WHERE fb_id = $fb_id AND asin = '" . $asinFromRequest . "' AND deleted != 1");
        } else {
            $q = $db->query("SELECT count(*) as num, error FROM favorites WHERE fb_id = $fb_id AND asin = '" . base64_decode($asin[1]) . "' AND deleted != 1");
        }
        $num = $q->fetchColumn(0);
        $error = $q->fetchColumn(1);
        if ($num == 1) {
            if ($error != 1) {
                $itemInfoPattern = str_replace("###add-to-fav-display###", "none", $itemInfoPattern);
                $itemInfoPattern = str_replace("###remove-from-fav-display###", "inline", $itemInfoPattern);
                $itemInfoPattern = str_replace("###update-fav-display###", "none", $itemInfoPattern);
            } else {
                $itemInfoPattern = str_replace("###add-to-fav-display###", "none", $itemInfoPattern);
                $itemInfoPattern = str_replace("###remove-from-fav-display###", "none", $itemInfoPattern);
                $itemInfoPattern = str_replace("###update-fav-display###", "inline", $itemInfoPattern);
            }
        } else {
            $itemInfoPattern = str_replace("###add-to-fav-display###", "inline", $itemInfoPattern);
            $itemInfoPattern = str_replace("###remove-from-fav-display###", "none", $itemInfoPattern);
            $itemInfoPattern = str_replace("###update-fav-display###", "none", $itemInfoPattern);
        }
        $asinForRow = base64_decode($asin[1]);
        $priceForRow = base64_decode($minimunPrice[1]);
        $smallImgURLForRow = $smallImageURL[1];
        $titleForRow = $title[1];
        $db->query("INSERT INTO user_seen_items (asin, price, small_img_url, title, fb_id, date, img_height, img_width) VALUES ('$asinForRow', '$priceForRow', '$smallImgURLForRow', '$titleForRow', $fb_id, now(), " . base64_decode($smallImageH[1]) . ", " . base64_decode($smallImageW[1]) . ")");
    } else {
        $itemInfoPattern = str_replace("###add-to-fav-display###", "none", $itemInfoPattern);
        $itemInfoPattern = str_replace("###update-fav-display###", "none", $itemInfoPattern);
    }
    $itemInfoPattern = str_replace("###example-search###", "example-search", $itemInfoPattern);
} else {
    $itemInfoPattern = str_replace("###add-to-fav-display###", "inline", $itemInfoPattern);
    $itemInfoPattern = str_replace("###remove-from-fav-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###example-search###", "example-search-gray", $itemInfoPattern);
    $itemInfoPattern = str_replace("###update-fav-display###", "none", $itemInfoPattern);
}

$itemInfoPattern = str_replace("###cache_file_url###", $folder . "/" . $filePath, $itemInfoPattern);

$bnTitle = explode("&&&", $splittedContent[30]);
$bnId = explode("&&&", $splittedContent[31]);

$itemInfoPattern = str_replace("###bn-title###", base64_decode($bnTitle[1]), $itemInfoPattern);
$itemInfoPattern = str_replace("###bn-id###", base64_decode($bnId[1]), $itemInfoPattern);

$ansTitle = explode("&&&", $splittedContent[32]);
$ansId = explode("&&&", $splittedContent[33]);

$itemInfoPattern = str_replace("###ans-title###", base64_decode($ansTitle[1]), $itemInfoPattern);
$itemInfoPattern = str_replace("###ans-id###", base64_decode($ansId[1]), $itemInfoPattern);


$test = base64_decode($content);
$pos = strpos($test, "error-item");

if ($pos !== false) {
    $itemInfoPattern = str_replace("###left-links-menu-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###right-links-menu-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###big-image-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###look-best-offers-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###add-to-fav-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###update-fav-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###remove-from-fav-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###var-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###most-popular2-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###most-popular-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###offers-link-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###price-display###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###if-error-item###", "inline", $itemInfoPattern);
    $itemInfoPattern = str_replace("###error-item-tip###", $test, $itemInfoPattern);
} else {
    $itemInfoPattern = str_replace("###left-links-menu-display###", "inline", $itemInfoPattern);
    $itemInfoPattern = str_replace("###right-links-menu-display###", "inline", $itemInfoPattern);
    if ($imageType == 'big') {
        $itemInfoPattern = str_replace("###big-image-display###", "none", $itemInfoPattern);
    } else {
        $itemInfoPattern = str_replace("###big-image-display###", "inline", $itemInfoPattern);
    }
    $itemInfoPattern = str_replace("###look-best-offers-display###", "inline", $itemInfoPattern);
    if (strlen($bnTitle[1]) > 5) {
        $itemInfoPattern = str_replace("###most-popular-display###", "inline", $itemInfoPattern);
    } else {
        $itemInfoPattern = str_replace("###most-popular-display###", "none", $itemInfoPattern);
    }
    if (strlen($ansTitle[1]) > 5) {
        $itemInfoPattern = str_replace("###most-popular2-display###", "inline", $itemInfoPattern);
    } else {
        $itemInfoPattern = str_replace("###most-popular2-display###", "none", $itemInfoPattern);
    }
    $itemInfoPattern = str_replace("###offers-link-display###", "inline", $itemInfoPattern);
    $itemInfoPattern = str_replace("###price-display###", "inline", $itemInfoPattern);
    $itemInfoPattern = str_replace("###if-error-item###", "none", $itemInfoPattern);
    $itemInfoPattern = str_replace("###error-item-tip###", "", $itemInfoPattern);
}

$db = null;

echo $itemInfoPattern;
?>