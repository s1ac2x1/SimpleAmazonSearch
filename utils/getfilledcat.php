<?php
$index = $_POST['index'];
$indexR = $_POST['indexR'];

class TopItem
{
    public $asin;
    public $imgUrl;
    public $imgH;
    public $imgW;
    public $title;
    public $subCategory;
}

function shortenTitle($title)
{
    if (strlen($title) > 55) {
        $result = substr($title, 0, 55);
        $result .= "...";
    } else {
        $result = $title;
    }
    return $result;
}

if ($index) {
    include("db.php");
    $arr = array();
    $popularItems = "<center><span style=\"font-family: georgia, serif; color: black; font-size: 18pt;\">$indexR</span>&nbsp;&nbsp;<span class=\"clear-field\" onclick=\"hideTopItems();\" style=\"position:relative;top:-3px;\">hide</span><br>" .
        "</center><br>";
    $counter = 1;
    $foundItems = array();
    foreach ($db->query("SELECT * FROM best_cat WHERE cat_index = '$index'") as $row) {
        $topItem = new TopItem();
        $topItem->asin = $row['asin'];
        $topItem->imgUrl = $row['img_url'];
        $topItem->imgH = $row['img_h'];
        $topItem->imgW = $row['img_w'];
        $topItem->title = base64_decode($row['title']);
        $topItem->subCategory = base64_decode($row['subCategory']);
        array_push($foundItems, $topItem);
    }

    $subCategoriesFiltered_ = array();
    $subCategoriesFiltered = array();
    foreach ($foundItems as $item) {
        if (!$subCategoriesFiltered_[$item->subCategory]) {
            $subCategoriesFiltered_[$item->subCategory] = true;
            array_push($subCategoriesFiltered, $item->subCategory);
        }
    }

    $count = 1;
    $menu = "subcategories live search:<br><input id=\"top-items-menu-filter\" type=\"text\" value=\"\" style=\"width:350px;position:relative;margin-bottom:5px;\" onkeyup=\"doFilterTopItemsMenu();\"><br><div id=\"top-items-menu-div\" class=\"top-items-menu\">" .
        "<table id=\"top-items-menu-table\" style=\"width:98%;padding:10px;\"><tr><td onclick=\"selectMenu($count);\"><span id=\"top-items-menu-span-$count\" class=\"top-items-menu-selected\">" . $subCategoriesFiltered[0] . "</span></td></tr>";
    for ($index = 1, $max_count = sizeof($subCategoriesFiltered); $index < $max_count; $index++) {
        $count++;
        $menu .= "<tr><td class=\"top-menu-item-td\" onclick=\"selectMenu($count);\"><span id=\"top-items-menu-span-$count\" class=\"top-items-menu-unselected\">" . $subCategoriesFiltered[$index] . "</span></td></tr>";
    }
    $menu .= "</table></div>";

    $content = "<div id=\"top-items-content-div\">";

    $table = "<div id=\"top-item-content-1\"><br><table><tr>";
    $tdCounter = 0;
    foreach ($foundItems as $item) {
        if ($item->subCategory == $subCategoriesFiltered[0]) {
            $tdCounter++;
            $top = 90 - ($item->imgH / 2);
            $left = ($item->imgW / 25) - 2;
            $encodedImage = "<img src='" . $item->imgUrl . "'>";
            $encodedImage = base64_encode($encodedImage);
            $table .= "<td><div id=\"top-item-td-$tdCounter\" class=\"top-items\" title=\"" . shortenTitle($item->title) . "\" onclick=\"loadLastViewedItem('" . $item->asin . "', false, false, true);\">" .
                "<div class=\"encodedImage\" style=\"display:none;\">$encodedImage</div><span style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\" class=\"decodedImage\"></span></div></td>";
            if ($tdCounter % 5 == 0) {
                $table .= "</tr><tr>";
            }
        }
    }
    $table .= "</tr></table></div>";
    $content .= $table;

    $count = 2;
    for ($index = 1, $max_count = sizeof($subCategoriesFiltered); $index < $max_count; $index++) {
        $table = "<div id=\"top-item-content-$count\" style=\"display:none;\"><br><table><tr>";
        $tdCounter = 0;
        foreach ($foundItems as $item) {
            if ($item->subCategory == $subCategoriesFiltered[$index]) {
                $tdCounter++;
                $top = 90 - ($item->imgH / 2);
                $left = ($item->imgW / 25) - 2;
                $encodedImage = "<img src='" . $item->imgUrl . "'>";
                $encodedImage = base64_encode($encodedImage);
                $table .= "<td><div id=\"top-item-td-$tdCounter\" class=\"top-items\" title=\"" . $item->title . "\" onclick=\"loadLastViewedItem('" . $item->asin . "');\">" .
                    "<div class=\"encodedImage\" style=\"display:none;\">$encodedImage</div><span style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\" class=\"decodedImage\"></span></div></td>";
                if ($tdCounter % 5 == 0) {
                    $table .= "</tr><tr>";
                }
            }
        }
        $table .= "</tr></table></div>";
        $content .= $table;
        $count++;
    }
    $content .= "</div><div id=\"how-many-top-items-for-that-index\" style=\"display:none;\">" . count($foundItems) . "</div>";

    echo $popularItems . "<table width=\"85%\">" .
        "<tr>" .
        "<td align=\"left\" valign=\"center\">$menu</td>" .
        "<td align=\"center\" valign=\"top\">$content</td>" .
        "</tr>" .
        "</table><br><br><br>";

    $db = null;
}
?>