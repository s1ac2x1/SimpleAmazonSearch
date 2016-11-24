<?php
$fb_id = $_POST['fb_id'];
include("../db.php");
$background = base64_encode(file_get_contents("http://simpleamazonsearch.com/img/noback.png"));
$db->query("UPDATE user_info SET background  = '$background' WHERE fb_id = $fb_id");
$db = null;
?>
