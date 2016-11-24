<?php
include("db.php");
$action = $_POST['action'];
$nick = $_POST['nick'];
$keyId = $_POST['key_id'];
$key = $_POST['key'];
$tag = $_POST['tag'];
if ($action == 'check') {
    $num = $db->query("SELECT COUNT(*) c FROM aff WHERE nick = '$nick'")->fetchColumn();
    if ($num > 0) {
        echo "bad";
    } else {
        if (strpos(trim($nick), "admin") === false && strpos(trim($nick), "kishlaly") === false) {
            echo "ok";
        } else {
            echo "bad";
        }
    }
} else if ($action == 'save') {
    $db->exec("INSERT INTO aff (nick, access_key_id, secret_access_key, tracking_id) VALUES ('$nick', '$keyId', '$key', '$tag')");
} else if ($action == 'verify') {
    include(dirname(__FILE__) . "/core/Search.php");
    $search = new Search($keyId, $tag, $key);
    $xml = $search->checkUsersAccountData();
    if ($xml == 'limit' || $xml->ItemSearchErrorResponse) {
        echo "bad";
    } else {
        echo "good";
    }
}
$db = null;
?>
