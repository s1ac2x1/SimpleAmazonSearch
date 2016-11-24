<?php
require_once("../core/WSRequest.php");
include("../db.php");

$counter = 1;
$randomTenCounter = 1;
$randomTen = getRandomTenBegin();
foreach ($db->query("SELECT * FROM best_cat") as $row) {
    $top = 90 - ($row['img_h'] / 2);
    $left = ($row['img_w'] / 25) - 2;
    $asin = ($row['asin'] / 25) - 2;
    $imgUrl = $row['img_url'];
    $detailsLink = base64_decode($row['details']);
    $itemBlock = "<a href=\"$detailsLink\" target=\"_blank\" rel=\"nofollow\">" .
        "<div class=\"top-items\">" .
        "<span style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src='$imgUrl' border=\"0\"></span>" .
        "</div>" .
        "</a><br>";
    $randomTen .= $itemBlock;
    if ($counter % 7 == 0) {
        $randomTen .= "</center></div>";
        $fh = fopen("cached/" . $randomTenCounter, "w");
        fwrite($fh, $randomTen);
        fclose($fh);
        $randomTenCounter++;
        $randomTen = getRandomTenBegin();
    }
    $counter++;
}

function getRandomTenBegin()
{
    return "<div><center>";
}

$db = null;
?>
