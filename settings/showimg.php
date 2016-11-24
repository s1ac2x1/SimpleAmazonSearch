<?php
header("Content-type: image/png");
$fb_id = $_GET['id'];
include("../db.php");
$q = $db->query("SELECT background FROM user_info WHERE fb_id = $id");
$image = base64_decode($q->fetchColumn());
$db = null;
echo $image;
?>
