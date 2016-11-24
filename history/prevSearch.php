<?php
header('Content-type: text/html; charset=UTF-8');
$fb_id = $_POST['fb_id'];
$limit = $_POST['limit'];
if ($fb_id && $limit) {
    include("../db.php");
    $html = "<span style=\"top:10px;position:relative;left:10px;\">quick search:&nbsp;<input type=\"text\" size=\"30\" onkeyup=\"filterTableRows('sc-table', 'prev-search-h');\" id=\"prev-search-h\"></span>" .
        "<span style=\"top:10px;position:relative;left:20px;\" id=\"history-qs-found\"></span>" .
        "<span class=\"example-search2\" style=\"float:right; right:10px; top:10px; position:relative;\" onclick=\"$('#prev-search-content').fadeOut('fast');\">close</span><br style=\"clear:both;\"><br><div id=\"sc-table-div\"><table class=\"bn-table\" id=\"sc-table\"><thead><tr><th><span class=\"example-search\">Click to sort titles</span></th></tr></thead>";
    $count = 0;
    $searches = array();
    foreach ($db->query("SELECT keyword FROM user_searches WHERE fb_id = $fb_id ORDER BY id DESC LIMIT $limit") as $row) {
        $cat = "";
        //if ($searches[base64_decode($row['keyword'])] != true) {
        $class = "no-d";
        if ($row['category_origin']) {
            $cat = "<b>" . $row['category_readable'] . "</b>: ";
        }
        $html .= "<tr class=\"$class\"><td onclick=\"pointToKeyword('" . $row['keyword'] . "');\">$cat<span style=\"cursor:pointer;\">" . base64_decode($row['keyword']) . "</span></td></tr>";
        $count++;
        //$searches[base64_decode($row['keyword'])] = true;
        //}
    }
    $db = null;
    $html .= "</table></div><div id=\"prev-history-count\" style=\"display:none;\">$count</div>";
    echo $html;
}
?>