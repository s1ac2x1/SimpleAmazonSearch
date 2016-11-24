<?php
$fb_id = $_POST['fb_id'];
$sc = $_POST['sc'];
$vc = $_POST['vc'];
include("../db.php");
$db->query("UPDATE user_info SET last_search_capacity = $sc, viewed_capacity = $vc WHERE fb_id = $fb_id");
$db = null;
?>
