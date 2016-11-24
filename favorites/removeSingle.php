<?php
$asin = $_POST['asin'];
$fb_id = $_POST['fb_id'];
$deleted = $_POST['deleted'];
if ($fb_id && $asin) {
    include("../db.php");
    $db->query("UPDATE favorites SET deleted = $deleted WHERE asin = '$asin' AND fb_id = $fb_id");
    $db = null;
}
?>