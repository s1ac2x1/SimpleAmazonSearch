<?php
include("../db.php");
$db->query("UPDATE favorites SET deleted = 1 WHERE fb_id = $fb_id");
$db = null;
?>
