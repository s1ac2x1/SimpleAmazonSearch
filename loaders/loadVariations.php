<?php
require_once(dirname(__FILE__) . "/../core/Search.php");
require_once(dirname(__FILE__) . "/../wrappers/VariationsMatrix.php");
require_once(dirname(__FILE__) . "/../wrappers/Variation.php");

function generateFindLink($asin)
{
    $conf = parse_ini_file(dirname(__FILE__) . "/../conf.ini");
    $fh = fopen(dirname(__FILE__) . "/../find/" . $asin, "a");
    fwrite($fh, "1");
    fclose($fh);
    return $conf['siteURL'] . "/find/" . $asin;
}

$asin = $_POST['asin'];
$accessKeyID = $_POST['accessKeyID'];
$secretAccessKey = $_POST['secretAccessKey'];
$trackingID = $_POST['trackingID'];

$accessKeyID = trim($accessKeyID);
$secretAccessKey = trim($secretAccessKey);
$trackingID = trim($trackingID);

if ($accessKeyID == 'undefined' || $accessKeyID == "") {
    $accessKeyID = null;
}
if ($secretAccessKey == 'undefined' || $secretAccessKey == "") {
    $secretAccessKey = null;
}
if ($trackingID == 'undefined' || $trackingID == "") {
    $trackingID = null;
}
$search = new Search($accessKeyID, $trackingID, $secretAccessKey);
$xml = $search->loadVariantsRawXML($asin);
if ($xml == 'limit') {
    header($_SERVER['SERVER_PROTOCOL'] . ' Limit', true, 500);
} else {
    $matrix = new VariationsMatrix();
    $variationsPart = $xml->Items->Item->Variations;
    $matrix->totalVariations = $variationsPart->TotalVariations;
    $result = "<div class=\"variations\"><center><h3>No variations for that item</h3>";
    if ($matrix->totalVariations && $matrix->totalVariations > 0) {
        foreach ($variationsPart->VariationDimensions->VariationDimension as $dimension) {
            array_push($matrix->variationDimensions, $dimension);
        }
        foreach ($variationsPart->Item as $variationItem) {
            if ($variationItem->VariationAttributes->VariationAttribute) {
                $variation = new Variation();
                $variation->asin = $variationItem->ASIN;
                foreach ($variationItem->VariationAttributes->VariationAttribute as $attr) {
                    $name = (string)$attr->Name;
                    $value = (string)$attr->Value;
                    $variation->attributes[$name] = $value;
                }
                array_push($matrix->variations, $variation);
            }
        }
        $result = "<div class=\"variations\"><center><h2>This item has " . $matrix->totalVariations . " variations:</h2>";
        $dimenstionsTable = "<table><tr>";
        foreach ($matrix->variationDimensions as $dimenstionName) {
            $dimenstionsTable .= "<td align=\"center\"><span style=\"padding:5px;\"><b>$dimenstionName</b></span></td>";
        }
        $dimenstionsTable .= "<td align=\"center\"><span style=\"padding:5px;\"><b>Link to item in Amazon</b></span></td>";
        $dimenstionsTable .= "</tr><tr>";
        foreach ($matrix->variations as $variation) {
            foreach ($matrix->variationDimensions as $dimensionName) {
                $stringDimension = (string)$dimensionName;
                $dimenstionsTable .= "<td align=\"center\"><span style=\"padding:5px;\">" . $variation->attributes[$stringDimension] . "</span></td>";
            }
            $dimenstionsTable .= "<td align=\"center\"><span style=\"padding-left:5px;padding-right:5px;\"><a href=\"" . generateFindLink($variation->asin) . "\" target=\"_blank\">more details</a></span></td>";
            $dimenstionsTable .= "</tr><tr>";
        }
        $dimenstionsTable .= "</tr></table>";
        $result .= $dimenstionsTable;
    }
    echo $result . "</center><div onclick=\"closeDiv('var-content');\" style=\"cursor:pointer;position:absolute;top:2px;right:2px;\"><img src=\"img/close_tr.png\"></div></div>";
}
?>
