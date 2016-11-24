<?php
$fb_id = $_POST['fb_id'];
include("../db.php");
$db->query("UPDATE user_info SET background  = default_background WHERE fb_id = $fb_id");
$db = null;
?>
