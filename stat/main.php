<?php

$fb_id = $_POST['fb_id'];

$result = "<div onclick=\"closeDiv('scroll-out');\" style=\"cursor:pointer;position:absolute;top:2px;right:2px;\"><img src=\"img/close_tr.png\"></div>";

include("../utils/db.php");

$dateTo = date("Y-m-d");
$q = $db->query("SELECT first_visit FROM user_info WHERE fb_id = $fb_id");
$dateFrom = $q->fetchColumn();

function dateTimeDiff($date1, $date2)
{

    $alt_diff = new stdClass();
    $alt_diff->y = floor(abs($date1->format('U') - $date2->format('U')) / (60 * 60 * 24 * 365));
    $alt_diff->m = floor((floor(abs($date1->format('U') - $date2->format('U')) / (60 * 60 * 24)) - ($alt_diff->y * 365)) / 30);
    $alt_diff->d = floor(floor(abs($date1->format('U') - $date2->format('U')) / (60 * 60 * 24)) - ($alt_diff->y * 365) - ($alt_diff->m * 30));
    $alt_diff->h = floor(floor(abs($date1->format('U') - $date2->format('U')) / (60 * 60)) - ($alt_diff->y * 365 * 24) - ($alt_diff->m * 30 * 24) - ($alt_diff->d * 24));
    $alt_diff->i = floor(floor(abs($date1->format('U') - $date2->format('U')) / (60)) - ($alt_diff->y * 365 * 24 * 60) - ($alt_diff->m * 30 * 24 * 60) - ($alt_diff->d * 24 * 60) - ($alt_diff->h * 60));
    $alt_diff->s = floor(floor(abs($date1->format('U') - $date2->format('U'))) - ($alt_diff->y * 365 * 24 * 60 * 60) - ($alt_diff->m * 30 * 24 * 60 * 60) - ($alt_diff->d * 24 * 60 * 60) - ($alt_diff->h * 60 * 60) - ($alt_diff->i * 60));
    $alt_diff->invert = (($date1->format('U') - $date2->format('U')) > 0) ? 0 : 1;

    return $alt_diff;
}

$from = new DateTime($dateFrom);
$to = new DateTime($dateTo);
$interval = dateTimeDiff($from, $to);

$period = "";
if ($interval->y > 0) {
    if ($interval->y == 1) {
        $period .= $interval->y . " year, ";
    } else {
        $period .= $interval->y . " years, ";
    }
}
if ($interval->m > 0) {
    if ($interval->m == 1) {
        $period .= $interval->m . " month, ";
    } else {
        $period .= $interval->m . " months, ";
    }
}
if ($interval->d > 0) {
    if ($interval->d == 1) {
        $period .= $interval->d . " day";
    } else {
        $period .= $interval->d . " days";
    }
}


$searchesCount = $db->query("SELECT COUNT(*) as count FROM user_searches WHERE fb_id = $fb_id")->fetchColumn();
$searchesCountGlobal = $db->query("SELECT COUNT(*) as count FROM user_searches")->fetchColumn();
$viewedCount = $db->query("SELECT COUNT(*) as count FROM user_seen_items WHERE fb_id = $fb_id")->fetchColumn();
$viewedCountGlobal = $db->query("SELECT COUNT(*) as count FROM user_seen_items")->fetchColumn();
$allFavCount = $db->query("SELECT COUNT(*) as count FROM favorites WHERE fb_id = $fb_id")->fetchColumn();
$totalFavCount = $db->query("SELECT COUNT(*) as count FROM favorites")->fetchColumn();
$currentFavCount = $db->query("SELECT COUNT(*) as count FROM favorites WHERE fb_id = $fb_id AND deleted = 0")->fetchColumn();

if ($currentFavCount > 0) {
    $favAdditionalText = "(and $currentFavCount at this point in the list)";
}

$viewedItemsMinTitle = $db->query("SELECT title FROM user_seen_items WHERE price = (SELECT MIN(NULLIF(price, 0)) FROM user_seen_items WHERE fb_id = $fb_id)")->fetchColumn();
$viewedItemsMinTitleGlobal = $db->query("SELECT title FROM user_seen_items WHERE price = (SELECT MIN(NULLIF(price, 0)) FROM user_seen_items)")->fetchColumn();

if (strcmp($viewedItemsMinTitle, $viewedItemsMinTitleGlobal) == 0) {
    $cheapestItemAdditional = "<br><span class=\"settings-content2\" style=\"position:relative;margin-left:10px;\">yes, it's was your searched item :)</span>";
}

$viewedItemsMaxTitle = $db->query("SELECT title FROM user_seen_items WHERE price = (SELECT MAX(NULLIF(price, 0)) FROM user_seen_items WHERE fb_id = $fb_id)")->fetchColumn();
$viewedItemsMaxTitleGlobal = $db->query("SELECT title FROM user_seen_items WHERE price = (SELECT MAX(NULLIF(price, 0)) FROM user_seen_items)")->fetchColumn();

if (strcmp($viewedItemsMaxTitle, $viewedItemsMaxTitleGlobal) == 0) {
    $viewedItemsMaxTitleGlobalAdditional = "<br><span class=\"settings-content2\" style=\"position:relative;margin-left:10px;\">yes, it's was your searched item :)</span>";
}

foreach ($db->query("SELECT keyword, COUNT(*) c FROM user_searches WHERE fb_id = $fb_id GROUP BY keyword HAVING c > 1;") as $row) {
    $arr[$row['keyword']] = $row['c'];
}

asort($arr);
$arr = array_reverse($arr, true);

$counter = 1;
foreach ($arr as $key => $value) {
    if ($counter <= 5) {
        $popularSearches .= "<span class=\"settings-content-underlined\" onclick=\"findByTitle_('$key', '', true)\" style=\"position:relative;margin-left:10px;\">" . base64_decode($key) . "</span><br>";
        $counter++;
    } else {
        break;
    }
}

if (!$popularSearches) {
    $popularSearches = "<br>";
}

foreach ($db->query("SELECT keyword, COUNT(*) c FROM user_searches GROUP BY keyword HAVING c > 1;") as $row) {
    $arrGlobal[$row['keyword']] = $row['c'];
}

asort($arrGlobal);
$arrGlobal = array_reverse($arrGlobal, true);

$counter = 1;
foreach ($arrGlobal as $key => $value) {
    if ($counter <= 5) {
        $popularSearchesGlobal .= "<span class=\"settings-content-underlined\" onclick=\"findByTitle_('$key', '', true)\" style=\"position:relative;margin-left:10px;\">" . base64_decode($key) . "</span><br>";
        $counter++;
    } else {
        break;
    }
}

if (!$popularSearchesGlobal) {
    $popularSearchesGlobal = "<br>";
}


foreach ($db->query("SELECT asin, small_img_url, img_width, img_height, title, COUNT(*) c FROM user_seen_items WHERE fb_id = $fb_id GROUP BY title HAVING c > 1;") as $row) {
    $values = array();
    $values['c'] = $row['c'];
    $values['img_url'] = $row['small_img_url'];
    $values['img_width'] = $row['img_width'];
    $values['img_height'] = $row['img_height'];
    $values['asin'] = $row['asin'];
    $items[$row['title']] = $values;
}

asort($items);
$items = array_reverse($items, true);

$popularItems = "<table><tr>";
$counter = 1;
foreach ($items as $key => $value) {
    if ($counter <= 15) {
        $top = 40 - ($value['img_height'] / 2);
        $left = ($value['img_width'] / 25) - 2;
        $popularItems .= "<td><div class=\"favorite-items\"><span onclick=\"loadLastViewedItem('" . $value['asin'] . "');\" style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src='" . base64_decode($value['img_url']) . "'></span></div></td>";
        if ($counter % 5 == 0) {
            $popularItems .= "</tr><tr>";
        }
        $counter++;
    } else {
        break;
    }
}
$popularItems .= "</tr></table>";

$usersCount = $db->query("SELECT COUNT(*) c FROM user_info")->fetchColumn();

// I hope site will has that amount of users soon =)
$usersCount += 150;

$db = null;

$result .= "<table width=\"100%\">" .
    "<tr>" .
    "<td align=\"left\" valign=\"top\">" .
    "<center><span class=\"settings-title\">Your statistics</span></center><br><br>" .
    "</td>" .
    "<td align=\"left\" valign=\"top\">" .
    "<center><span class=\"settings-title\">Global</span></center><br><br>" .
    "</td>" .
    "</tr>" .

    "<tr>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">How long are you here</span><br><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$period</span><br><br>" .
    "</td>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">Amount of site's users</span><br><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$usersCount</span><br><br>" .
    "</td>" .
    "</tr>" .

    "<tr>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">How many items</span><br>" .
    "<table>" .
    "<tr><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">have you searched for:</td><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$searchesCount</span><br></td></tr>" .
    "<tr><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">have you viewed:</td><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$viewedCount</span><br></td></tr>" .
    "<tr><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">were in favorites:</td><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$allFavCount $favAdditionalText</span><br></td></tr>" .
    "</table><br><br>" .
    "</td>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">How many items</span><br>" .
    "<table>" .
    "<tr><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">have people searched for:</td><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$searchesCountGlobal</span><br></td></tr>" .
    "<tr><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">have people viewed:</td><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$viewedCountGlobal</span><br></td></tr>" .
    "<tr><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">were in favorites:</td><td><span class=\"settings-content\" style=\"position:relative;margin-left:10px;\">$totalFavCount</span><br></td></tr>" .
    "</table><br><br>" .
    "</td>" .
    "</tr>" .

    "<tr>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">The cheapest item was:</span><br><span class=\"settings-content-underlined\" onclick=\"findByTitle_('$viewedItemsMinTitle', '', true)\" style=\"position:relative;margin-left:10px;\">" . base64_decode($viewedItemsMinTitle) . "</span><br><br>" .
    "</td>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">The cheapest item was:</span><br><span class=\"settings-content-underlined\" onclick=\"findByTitle_('$viewedItemsMinTitleGlobal', '', true)\" style=\"position:relative;margin-left:10px;\">" . base64_decode($viewedItemsMinTitleGlobal) . "</span>$cheapestItemAdditional<br><br>" .
    "</td>" .
    "</tr>" .

    "<tr>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">Most expensive item was:</span><br><span class=\"settings-content-underlined\" onclick=\"findByTitle_('$viewedItemsMaxTitle', '', true)\" style=\"position:relative;margin-left:10px;\">" . base64_decode($viewedItemsMaxTitle) . "</span><br><br>" .
    "</td>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">Most expensive item was:</span><br><span class=\"settings-content-underlined\" onclick=\"findByTitle_('$viewedItemsMaxTitleGlobal', '', true)\" style=\"position:relative;margin-left:10px;\">" . base64_decode($viewedItemsMaxTitleGlobal) . "</span>$viewedItemsMaxTitleGlobalAdditional<br><br>" .
    "</td>" .
    "</tr>" .

    "<tr>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">Popular searches:</span><br>$popularSearches<br>" .
    "</td>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">Popular searches:</span><br>$popularSearchesGlobal<br>" .
    "</td>" .
    "</tr>" .
    "<tr>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">Popular items:</span><br>$popularItems<br><br>" .
    "</td>" .
    "<td align=\"left\" valign=\"top\">" .
    "<span class=\"settings-title2\" style=\"position:relative;margin-left:10px;\">Popular items:</span><br>$popularItems<br><br>" .
    "</td>" .
    "</tr>" .
    "</table>";

echo $result;

?>
