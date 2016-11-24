<?php
require_once("FavoriteItem.php");
require_once("FavoritesListBuilder.php");

$fb_id = $_POST['fb_id'];
if ($fb_id) {
    include("../db.php");

    $num = $db->query("SELECT count(*) as num FROM favorites WHERE fb_id = $fb_id AND deleted != 1")->fetchColumn();

    if ($num < 1) {
        $favorites = "You have not added any items to favorites";
    } else {
        $items = array();
        foreach ($db->query("SELECT * FROM favorites WHERE fb_id = $fb_id AND deleted != 1") as $row) {
            array_push($items, new FavoriteItem($row['id'], $row['asin'], $row['title'], $row['small_img_url'], $row[date], $row[fb_id], $row['img_height'], $row['img_width'], $row['error'], $row['price']));
        }
        $builder = new FavoritesListBuilder($items);
        $favorites = $builder->html();
    }

    $db = null;

    echo $favorites;
}
?>
