<?php
require_once(dirname(__FILE__) . "/../core/Parser.php");
require_once(dirname(__FILE__) . "/../html/BaseSearchHTML.php");
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

$keyword = $_POST['keyword'];
$fb_id = $_POST['fb_id'];
$category = $_POST['category'];
if (!$category || $category == 'undefined') {
    $category = "All";
}

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

$parser = new Parser();
$baseSearchWrapper = $parser->getBaseSearchWrapper($keyword, $category, $accessKeyID, $secretAccessKey, $trackingID);
$baseSearchHTML = new BaseSearchHTML($baseSearchWrapper, "base_search");

date_default_timezone_set('Europe/Kiev');

$currDate = date("d-m-Y");
if (!is_dir(dirname(__FILE__) . "/../logs/" . $currDate)) {
    mkdir(dirname(__FILE__) . "/../logs/" . $currDate);
}

$fh = fopen(dirname(__FILE__) . "/../logs/" . $currDate . "/requests", "a");
fwrite($fh, date("H:i:s") . "***" . $keyword . "\n");
fclose($fh);

$randomFileName = sha1($keyword);

if (!file_exists(dirname(__FILE__) . "/../search/" . $randomFileName)) {
    $fh = fopen(dirname(__FILE__) . "/../search/" . $randomFileName, "a");
    fwrite($fh, $keyword);
    fclose($fh);
}

if ($fb_id > 0) {
    include("../db.php");
    $db->query("INSERT INTO user_searches (fb_id, keyword, date) VALUES ('" . $fb_id . "', '" . base64_encode($keyword) . "', now())");
    $db = null;
}


if ($baseSearchHTML->good()) {
    echo $baseSearchHTML->printCircles();
} else {
    if ($baseSearchHTML->isLimit()) {
        header($_SERVER['SERVER_PROTOCOL'] . ' Limit', true, 500);
    } else {
        echo "no";
    }
}

?>