<?php
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

class FavoritesListBuilder
{

    private $favoriteItems;

    public function __construct($favoriteItems)
    {
        $this->favoriteItems = $favoriteItems;
    }


    public function html()
    {
        $html = "<br><table><tr>";
        $count = 1;
        $date1 = date("Y-m-d");
        foreach ($this->favoriteItems as $item) {
            $top = 40 - ($item->imgH / 2);
            $left = ($item->imgW / 25) - 2;

            $days = CacheHelper::days($date1) - CacheHelper::days($item->date);

            if ($item->error != 1) {
                $hint = $item->title;
            } else {
                $hint = "";
            }
            if ($days >= 5) {
                $updateHTML = "<div style=\"cursor:pointer;position:absolute;top:2px;left:2px;\" onmouseover=\"updateFavHintShow('" . $days . "', 'fav-update-img-$count');\" onmouseout=\"updateFavHintHide();\" onclick=\"updateFav('" . $item->asin . "', '" . $item->fb_id . "', '$count');\"><img id=\"fav-update-img-$count\" src=\"img/updateFav.png\"></div>";
            } else {
                $updateHTML = "";
            }
            $price = "$" . number_format($item->price / 100, 0, '.', ',');
            $title_ = base64_decode($item->title);
            $title = "";
            if (strlen($title_) > 80) {
                $title = substr($title_, 0, 80);
                $title .= "...";
            } else {
                $title = $title_;
            }

            $tip = "<center><font style=\"font-family: georgia, serif;font-size: 18pt; font-weight:bold;\">" . $price . "</font><br><font style=\"font-family: georgia, serif;font-size: 14pt;\">" . $title . "</font></center>";
            $html .= "<td><div class=\"favorite-items\" id=\"fav-item-$count\"><span onmouseover=\"favOver('" . base64_encode($tip) . "');\" onmouseout=\"favOut();\" onclick=\"loadFav('" . $item->asin . "');\" style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src='" . $item->smallImgURL_decoded . "'></span><div style=\"cursor:pointer;position:absolute;top:2px;right:2px;\" onmouseover=\"favRemOver('" . $hint . "');\" onmouseout=\"favRemOut();\" onclick=\"remFavFromImg('" . $item->asin . "', '" . $item->fb_id . "', '" . $item->title . "', $count);\"><img src=\"img/remfav.png\"></div>$updateHTML</div></td>";
            $count++;
        }
        $html .= "</tr></table><br>";
        return $html;
    }

}

?>
