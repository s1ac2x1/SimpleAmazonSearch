<?php
require_once(dirname(__FILE__) . "/../core/Parser.php");
require_once(dirname(__FILE__) . "/../html/BaseSearchHTML.php");

$keyword = $_POST['keyword'];
$index = $_POST['index'];
$readableIndex = $_POST['readableIndex'];
$fb_id = $_POST['fb_id'];
$parser = new Parser();
$baseSearchWrapper = $parser->getBaseSearchWrapper($keyword, $index);
$baseSearchHTML = new BaseSearchHTML($baseSearchWrapper, "index_search");

date_default_timezone_set('Europe/Kiev');

$currDate = date("d-m-Y");
if (!is_dir(dirname(__FILE__) . "/../logs/" . $currDate)) {
    mkdir(dirname(__FILE__) . "/../logs/" . $currDate);
}

$fh = fopen(dirname(__FILE__) . "/../logs/" . $currDate . "/requests", "a");
fwrite($fh, date("H:i:s") . "***" . $keyword . "***" . $readableIndex . "\n");
fclose($fh);

if ($fb_id > 0) {
    include("../db.php");
    $db->query("INSERT INTO user_searches (fb_id, keyword, category_origin, category_readable, date) VALUES (" . $fb_id . ", '" . base64_encode($keyword) . "', '" . $index . "', '" . $readableIndex . "', now())");
    $db = null;
}


if ($baseSearchHTML->good()) {
    echo $baseSearchHTML->printIndexCached();
} else {
    //echo $baseSearchHTML->printErrorMessage();
    echo "no";
}

?>
