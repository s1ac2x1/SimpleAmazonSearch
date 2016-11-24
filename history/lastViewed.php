<?php
header('Content-type: text/html; charset=UTF-8');
$fb_id = $_POST['fb_id'];
$limit = $_POST['limit'];
if ($fb_id && $limit) {
    include("../db.php");
    //$sql = "SELECT * FROM user_seen_items WHERE fb_id = $fb_id ORDER BY id DESC LIMIT $limit";
    $html = "<span style=\"top:10px;position:relative;left:10px;\">quick search:&nbsp;<input type=\"text\" size=\"30\" onkeyup=\"filterTableRows('lw-table', 'last-viewed-h');\" id=\"last-viewed-h\"></span>" .
        "<span style=\"top:10px;position:relative;left:20px;\" id=\"last-viewed-found\"></span>" .
        "<span class=\"example-search2\" style=\"float:right; right:10px; top:10px; position:relative;\" onclick=\"$('#last-viewed-content').fadeOut('fast');\">close</span><br style=\"clear:both;\"><br><div id=\"lw-table-div\"><table class=\"bn-table\" id=\"lw-table\"><thead><tr><th><span class=\"example-search\">sort</span></th><th><span class=\"example-search\">sort</span></th><th style=\"width:100px;\"><span class=\"example-search\">sort</span></th></tr></thead>";
    $count = 0;
    $searches = array();
    foreach ($db->query("SELECT id, asin, price, title, img_height, img_width, small_img_url FROM user_seen_items WHERE fb_id = $fb_id ORDER BY id DESC LIMIT $limit") as $row) {
        $top = 40 - ($row['img_height'] / 2);
        $left = ($row['img_width'] / 25) - 2;
        $cat = "";
        //if ($searches[$row['asin']] != true) {
        $class = "lw-no-d";
        $price = "$" . number_format($row['price'] / 100, 0, '.', ',');
        $html .= "<tr class=\"$class\">" .
            "<td onclick=\"loadLastViewedItem('" . $row['asin'] . "');\" style=\"width:100px;\"><div class=\"lw-items\" id=\"lw-item-$count\"><span style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src=\"" . base64_decode($row['small_img_url']) . "\" width=\"" . $row['img_width'] . "\" height=\"" . $row['img_height'] . "\"></span></div></td>" .
            "<td onclick=\"loadLastViewedItem('" . $row['asin'] . "');\"><span style=\"cursor:pointer;\">" . base64_decode($row['title']) . "</span></td>" .
            "<td onclick=\"loadLastViewedItem('" . $row['asin'] . "');\" align=\"center\">$price</td>" .
            "</tr>";
        $count++;
        //$searches[$row['asin']] = true;
        //}
    }
    $fb = null;
    $html .= "</table></div><div id=\"viewed-count\" style=\"display:none;\">$count</div>";
    echo $html;
}
?>