<?php
require_once(dirname(__FILE__) . "/../wrappers/BaseSearchSingleItemWrapper.php");
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

class BaseSearchHTML
{

    private $baseSearchWrapper;
    private $errorMessage;
    private $parsedItemsWrappers = array();
    private $correctedItemsWrappers = array();
    private $parsedItems = array();
    private $correctedItems = array();
    private $cachedFilesNames = array();
    private $cacheFolderName;

    public function __construct($baseSearchWrapper, $cacheFolderName)
    {
        if ($baseSearchWrapper && $cacheFolderName) {
            $this->cacheFolderName = $cacheFolderName;
            $this->baseSearchWrapper = $baseSearchWrapper;
            if ($this->baseSearchWrapper->errorMessage != "ok") {
                $this->errorMessage = $this->baseSearchWrapper->errorMessage;
            } else {
                foreach ($this->baseSearchWrapper->items as $item) {
                    $singleItemWrapper = new BaseSearchSingleItemWrapper();
                    $singleItemWrapper->asin = $item->ASIN;
                    $singleItemWrapper->minimunPrice = $this->getItemMinPrice($item);
                    $singleItemWrapper->mediumImageHeight = $item->MediumImage->Height;
                    $singleItemWrapper->mediumImageWidth = $item->MediumImage->Width;
                    array_push($this->parsedItemsWrappers, $singleItemWrapper);
                    array_push($this->parsedItems, $item);
                }
                $this->removeTooCheapFromItemWrappersList();
                $this->removeTooCheapFromItemsList();
                foreach ($this->correctedItems as $item) {
                    $this->saveItemInCache($item);
                }
            }
        }
    }

    function encodeString($input)
    {
        foreach (str_split($input) as $obj) {
            $output .= '&#' . ord($obj) . ';';
        }
        return $output;
    }

    public function getItemMinPrice($item)
    {
        if ($item->OfferSummary->LowestNewPrice->Amount) {
            $lowestNewPrice = $item->OfferSummary->LowestNewPrice->Amount;
        } else if ($item->OfferSummary->LowestUsedPrice->Amount) {
            $lowestNewPrice = $item->OfferSummary->LowestUsedPrice->Amount;
        } else if ($item->OfferSummary->LowestRefurbishedPrice->Amount) {
            $lowestNewPrice = $item->OfferSummary->LowestRefurbishedPrice->Amount;
        } else if ($item->OfferSummary->TotalCollectiblePrice->Amount) {
            $lowestNewPrice = $item->OfferSummary->TotalCollectiblePrice->Amount;
        }
        $price = $item->Offers->Offer[0]->OfferListing->Price->Amount;
        $minPrice = 0;
        if ($lowestNewPrice && $price) {
            $minPrice = min($lowestNewPrice, $price);
        } else {
            if (!$lowestNewPrice && $price) {
                $minPrice = $price;
            }
            if ($lowestNewPrice && !$price) {
                $minPrice = $lowestNewPrice;
            }
        }
        return $minPrice;
    }

    function prepareStringForCache($key, $value)
    {
        $value = base64_encode(strip_tags($value, "<p><br><b><ul><li>"));
        return $key . "&&&" . $value . "***";
    }

    public function saveItemInCache($item)
    {
        $micro = microtime();
        date_default_timezone_set('Europe/Kiev');
        $currDate = date("d-m-Y_H-i");
        $t = str_replace(" ", "", $micro);
        $t = str_replace(".", "", $t);
        $uuid = CacheHelper::gen_uuid();
        $uuid = str_replace("-", "", $uuid);
        $cacheFileName = $currDate . "/" . $t . $uuid;
        if (!is_dir(dirname(__FILE__) . "/../cache/" . $this->cacheFolderName . "/" . $currDate)) {
            mkdir(dirname(__FILE__) . "/../cache/" . $this->cacheFolderName . "/" . $currDate);
        }
        $cacheFile = fopen(dirname(__FILE__) . "/../cache/" . $this->cacheFolderName . "/" . $cacheFileName, "w");

        fwrite($cacheFile, $this->prepareStringForCache("ASIN", $item->ASIN));
        fwrite($cacheFile, $this->prepareStringForCache("minimunPrice", $this->getItemMinPrice($item)));
        fwrite($cacheFile, $this->prepareStringForCache("mediumImageURL", $item->ImageSets->ImageSet->MediumImage->URL));
        fwrite($cacheFile, $this->prepareStringForCache("mediumImageHeight", $item->ImageSets->ImageSet->MediumImage->Height));
        fwrite($cacheFile, $this->prepareStringForCache("mediumImageWidth", $item->ImageSets->ImageSet->MediumImage->Width));
        fwrite($cacheFile, $this->prepareStringForCache("bigImageURL", $item->ImageSets->ImageSet->LargeImage->URL));

        $features = "";
        foreach ($item->ItemAttributes->Feature as $feature) {
            $features .= $feature . "@@@";
        }
        $features = rtrim($features, "@@@");

        fwrite($cacheFile, $this->prepareStringForCache("featues", $features, true));
        fwrite($cacheFile, $this->prepareStringForCache("review", $item->EditorialReviews->EditorialReview->Content));
        if (strlen($item->Offers->MoreOffersUrl) > 5) {
            fwrite($cacheFile, $this->prepareStringForCache("offersURL", $item->Offers->MoreOffersUrl));
        } else {
            fwrite($cacheFile, $this->prepareStringForCache("offersURL", $item->DetailPageURL));
        }

        fwrite($cacheFile, $this->prepareStringForCache("offersNew", $item->OfferSummary->TotalNew));
        fwrite($cacheFile, $this->prepareStringForCache("offersUsed", $item->OfferSummary->TotalUsed));
        fwrite($cacheFile, $this->prepareStringForCache("offersRefurbished", $item->OfferSummary->TotalRefurbished));
        fwrite($cacheFile, $this->prepareStringForCache("title", $item->ItemAttributes->Title));
        fwrite($cacheFile, $this->prepareStringForCache("details_link", $item->ItemLinks->ItemLink[0]->URL));
        fwrite($cacheFile, $this->prepareStringForCache("baby_link", $item->ItemLinks->ItemLink[1]->URL));
        fwrite($cacheFile, $this->prepareStringForCache("wedding_link", $item->ItemLinks->ItemLink[2]->URL));
        fwrite($cacheFile, $this->prepareStringForCache("wishlist_link", $item->ItemLinks->ItemLink[3]->URL));
        fwrite($cacheFile, $this->prepareStringForCache("friend_link", $item->ItemLinks->ItemLink[4]->URL));
        fwrite($cacheFile, $this->prepareStringForCache("review_link", $item->ItemLinks->ItemLink[5]->URL));

        $similarASINs = "";
        $similarTitles = "";
        if ($item->SimilarProducts) {
            foreach ($item->SimilarProducts->SimilarProduct as $product) {
                $similarASINs .= $product->ASIN . "@@@";
                $similarTitles .= $product->Title . "@@@";
            }
            $similarASINs = rtrim($similarASINs, "@@@");
            $similarTitles = rtrim($similarTitles, "@@@");
        }

        fwrite($cacheFile, $this->prepareStringForCache("similarASINs", $similarASINs));
        fwrite($cacheFile, $this->prepareStringForCache("similarTitles", $similarTitles));

        $accessoriesASINs = "";
        $accessoriesTitles = "";
        if ($item->Accessories) {
            foreach ($item->Accessories->Accessory as $accessory) {
                $accessoriesASINs .= $accessory->ASIN . "@@@";
                $accessoriesTitles .= $accessory->Title . "@@@";
            }
            $accessoriesASINs = rtrim($accessoriesASINs, "@@@");
            $accessoriesTitles = rtrim($accessoriesTitles, "@@@");
        }

        fwrite($cacheFile, $this->prepareStringForCache("accessoriesASINs", $accessoriesASINs));
        fwrite($cacheFile, $this->prepareStringForCache("accessoriesTitles", $accessoriesTitles));
        fwrite($cacheFile, $this->prepareStringForCache("parentASIN", $item->ParentASIN));
        fwrite($cacheFile, $this->prepareStringForCache("binding", $item->ItemAttributes->Binding));
        fwrite($cacheFile, $this->prepareStringForCache("bigImageHeight", $item->ImageSets->ImageSet->LargeImage->Height));
        fwrite($cacheFile, $this->prepareStringForCache("bigImageWidth", $item->ImageSets->ImageSet->LargeImage->Width));
        fwrite($cacheFile, $this->prepareStringForCache("smallImageURL", $item->ImageSets->ImageSet->SmallImage->URL));
        fwrite($cacheFile, $this->prepareStringForCache("smallImageH", $item->ImageSets->ImageSet->SmallImage->Height));
        fwrite($cacheFile, $this->prepareStringForCache("smallImageW", $item->ImageSets->ImageSet->SmallImage->Width));
        fwrite($cacheFile, $this->prepareStringForCache("browseNodeTitle", $item->BrowseNodes->BrowseNode->Name));
        fwrite($cacheFile, $this->prepareStringForCache("browseNodeId", $item->BrowseNodes->BrowseNode->BrowseNodeId));
        fwrite($cacheFile, $this->prepareStringForCache("ancestorTitle", $item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Name));
        fwrite($cacheFile, $this->prepareStringForCache("ancestorId", $item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->BrowseNodeId));

        fclose($cacheFile);

        array_push($this->cachedFilesNames, $cacheFileName);
    }

    public function getItemInfo($item)
    {
        $result = "";
        $result .= $this->prepareStringForCache("ASIN", $item->ASIN);
        $result .= $this->prepareStringForCache("minimunPrice", $this->getItemMinPrice($item));
        $result .= $this->prepareStringForCache("mediumImageURL", $item->ImageSets->ImageSet->MediumImage->URL);
        $result .= $this->prepareStringForCache("mediumImageHeight", $item->ImageSets->ImageSet->MediumImage->Height);
        $result .= $this->prepareStringForCache("mediumImageWidth", $item->ImageSets->ImageSet->MediumImage->Width);
        $result .= $this->prepareStringForCache("bigImageURL", $item->ImageSets->ImageSet->LargeImage->URL);

        $features = "";
        foreach ($item->ItemAttributes->Feature as $feature) {
            $features .= $feature . "@@@";
        }
        $features = rtrim($features, "@@@");

        $result .= $this->prepareStringForCache("featues", $features, true);
        $result .= $this->prepareStringForCache("review", $item->EditorialReviews->EditorialReview->Content);
        if (strlen($item->Offers->MoreOffersUrl) > 5) {
            $result .= $this->prepareStringForCache("offersURL", $item->Offers->MoreOffersUrl);
        } else {
            $result .= $this->prepareStringForCache("offersURL", $item->DetailPageURL);
        }

        $result .= $this->prepareStringForCache("offersNew", $item->OfferSummary->TotalNew);
        $result .= $this->prepareStringForCache("offersUsed", $item->OfferSummary->TotalUsed);
        $result .= $this->prepareStringForCache("offersRefurbished", $item->OfferSummary->TotalRefurbished);
        $result .= $this->prepareStringForCache("title", $item->ItemAttributes->Title);
        $result .= $this->prepareStringForCache("details_link", $item->ItemLinks->ItemLink[0]->URL);
        $result .= $this->prepareStringForCache("baby_link", $item->ItemLinks->ItemLink[1]->URL);
        $result .= $this->prepareStringForCache("wedding_link", $item->ItemLinks->ItemLink[2]->URL);
        $result .= $this->prepareStringForCache("wishlist_link", $item->ItemLinks->ItemLink[3]->URL);
        $result .= $this->prepareStringForCache("friend_link", $item->ItemLinks->ItemLink[4]->URL);
        $result .= $this->prepareStringForCache("review_link", $item->ItemLinks->ItemLink[5]->URL);

        $similarASINs = "";
        $similarTitles = "";
        if ($item->SimilarProducts) {
            foreach ($item->SimilarProducts->SimilarProduct as $product) {
                $similarASINs .= $product->ASIN . "@@@";
                $similarTitles .= $product->Title . "@@@";
            }
            $similarASINs = rtrim($similarASINs, "@@@");
            $similarTitles = rtrim($similarTitles, "@@@");
        }

        $result .= $this->prepareStringForCache("similarASINs", $similarASINs);
        $result .= $this->prepareStringForCache("similarTitles", $similarTitles);

        $accessoriesASINs = "";
        $accessoriesTitles = "";
        if ($item->Accessories) {
            foreach ($item->Accessories->Accessory as $accessory) {
                $accessoriesASINs .= $accessory->ASIN . "@@@";
                $accessoriesTitles .= $accessory->Title . "@@@";
            }
            $accessoriesASINs = rtrim($accessoriesASINs, "@@@");
            $accessoriesTitles = rtrim($accessoriesTitles, "@@@");
        }

        $result .= $this->prepareStringForCache("accessoriesASINs", $accessoriesASINs);
        $result .= $this->prepareStringForCache("accessoriesTitles", $accessoriesTitles);
        $result .= $this->prepareStringForCache("parentASIN", $item->ParentASIN);
        $result .= $this->prepareStringForCache("binding", $item->ItemAttributes->Binding);
        $result .= $this->prepareStringForCache("bigImageHeight", $item->ImageSets->ImageSet->LargeImage->Height);
        $result .= $this->prepareStringForCache("bigImageWidth", $item->ImageSets->ImageSet->LargeImage->Width);
        $result .= $this->prepareStringForCache("smallImageURL", $item->ImageSets->ImageSet->SmallImage->URL);
        $result .= $this->prepareStringForCache("smallImageH", $item->ImageSets->ImageSet->SmallImage->Height);
        $result .= $this->prepareStringForCache("smallImageW", $item->ImageSets->ImageSet->SmallImage->Width);
        $result .= $this->prepareStringForCache("browseNodeTitle", $item->BrowseNodes->BrowseNode->Name);
        $result .= $this->prepareStringForCache("browseNodeId", $item->BrowseNodes->BrowseNode->BrowseNodeId);
        $result .= $this->prepareStringForCache("ancestorTitle", $item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Name);
        $result .= $this->prepareStringForCache("ancestorId", $item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->BrowseNodeId);

        return $result;
    }


    public function good()
    {
        return ($this->baseSearchWrapper->errorMessage == "ok" & count($this->correctedItemsWrappers) > 0);
    }

    public function isLimit()
    {
        return ($this->baseSearchWrapper->errorMessage == "limit");
    }

    public function printErrorMessage()
    {
        return $this->buildErrorMessage();
    }

    private function buildErrorMessage()
    {
        return $this->errorMessage;
    }

    private function cmp($a, $b)
    {
        $aPrice = intval($a->minimunPrice);
        $bPrice = intval($b->minimunPrice);
        if ($aPrice == $bPrice) {
            return 0;
        }
        if ($aPrice < $bPrice) {
            return -1;
        }
        if ($aPrice > $bPrice) {
            return 1;
        }
    }

    private function cmp2($a, $b)
    {
        $aPrice = intval($a->Offers->Offer[0]->OfferListing->Price->Amount);
        $bPrice = intval($b->Offers->Offer[0]->OfferListing->Price->Amount);
        if ($aPrice == $bPrice) {
            return 0;
        }
        if ($aPrice < $bPrice) {
            return -1;
        }
        if ($aPrice > $bPrice) {
            return 1;
        }
    }

    private function removeTooCheapFromItemWrappersList()
    {
        if (count($this->parsedItemsWrappers) == 1) {
            array_push($this->correctedItemsWrappers, $this->parsedItemsWrappers[0]);
        } else {
            $sum = 0;
            foreach ($this->parsedItemsWrappers as $item) {
                $sum += $item->minimunPrice;
            }
            $avg = $sum / count($this->parsedItemsWrappers);
            $halfOfAvg = $avg / 2;
            $quorterOfAvg = $avg / 4;
            foreach ($this->parsedItemsWrappers as $item) {
                if ($item->minimunPrice > 0) {
                    if ($item->minimunPrice > ($halfOfAvg + $quorterOfAvg)) {
                        array_push($this->correctedItemsWrappers, $item);
                    }
                }
            }
            usort($this->correctedItemsWrappers, array($this, 'cmp'));
        }
    }

    private function removeTooCheapFromItemsList()
    {
        if (count($this->parsedItems) == 1) {
            array_push($this->correctedItems, $this->parsedItems[0]);
        } else {
            $sum = 0;
            foreach ($this->parsedItems as $item) {
                $sum += $item->Offers->Offer[0]->OfferListing->Price->Amount;
            }
            $avg = $sum / count($this->parsedItems);
            $halfOfAvg = $avg / 2;
            $quorterOfAvg = $avg / 4;
            foreach ($this->parsedItems as $item) {
                if ($item->Offers->Offer[0]->OfferListing->Price->Amount > 0) {
                    if ($item->Offers->Offer[0]->OfferListing->Price->Amount > ($halfOfAvg + $quorterOfAvg)) {
                        array_push($this->correctedItems, $item);
                    }
                }
            }
            usort($this->correctedItems, array($this, 'cmp2'));
        }
    }

    public function printCircles()
    {
        $baseSearchCirclesPattern = file_get_contents(dirname(__FILE__) . "/../patterns/base_search_circles.pattern");
        $baseSearchCirclesPattern = str_replace("###base_search.circles.minPrice###", "$" . number_format($this->correctedItemsWrappers[0]->minimunPrice / 100, 0, '.', ','), $baseSearchCirclesPattern);
        $baseSearchCirclesPattern = str_replace("###base_search.circles.maxPrice###", "$" . number_format($this->correctedItemsWrappers[count($this->correctedItemsWrappers) - 1]->minimunPrice / 100, 0, '.', ','), $baseSearchCirclesPattern);
        $circleSpans = "";
        for ($i = 1; $i < count($this->correctedItemsWrappers); $i++) {
            $circleSpans .= "<span class=\"prices-range-circles\"><img id=\"circle-" . $i . "\" src=\"img/circle-blue.png\"></span>";
        }
        $hiddenDivs = "<div id='found-items-count' style='display: none;'>" . count($this->cachedFilesNames) . "</div>";
        $caheFilesCount = 1;
        foreach ($this->cachedFilesNames as $fileName) {
            $hiddenDivs .= "<div id='cached-item-" . $caheFilesCount . "' style='display: none;'>" . $fileName . "</div>";
            $caheFilesCount++;
        }
        $baseSearchCirclesPattern = str_replace("###base_search.circles###", $circleSpans, $baseSearchCirclesPattern);
        $baseSearchCirclesPattern = str_replace("###debug###", $this->baseSearchWrapper->debug, $baseSearchCirclesPattern);
        $baseSearchCirclesPattern .= $hiddenDivs;
        return $baseSearchCirclesPattern . "<div id=\"total-items-matches-search\" style=\"display:none;\">" . $this->baseSearchWrapper->totalResults . "</div>";
    }

    public function printIndexCached()
    {
        $baseSearchCirclesPattern = file_get_contents(dirname(__FILE__) . "/../patterns/base_search_circles.pattern");
        $baseSearchCirclesPattern = str_replace("###base_search.circles.minPrice###", "$" . number_format($this->correctedItemsWrappers[0]->minimunPrice / 100, 0, '.', ','), $baseSearchCirclesPattern);
        $baseSearchCirclesPattern = str_replace("###base_search.circles.maxPrice###", "$" . number_format($this->correctedItemsWrappers[count($this->correctedItemsWrappers) - 1]->minimunPrice / 100, 0, '.', ','), $baseSearchCirclesPattern);
        $circleSpans = "";
        for ($i = 1; $i < count($this->correctedItemsWrappers); $i++) {
            $circleSpans .= "<span class=\"prices-range-circles\"><img id=\"index-circle-" . $i . "\" src=\"img/circle-blue.png\"></span>";
        }
        $hiddenDivs = "<div id='found-cached-items-count' style='display: none;'>" . count($this->cachedFilesNames) . "</div>";
        $caheFilesCount = 1;
        foreach ($this->cachedFilesNames as $fileName) {
            $hiddenDivs .= "<div id='cached-index-item-" . $caheFilesCount . "' style='display: none;'>" . $fileName . "</div>";
            $caheFilesCount++;
        }
        $baseSearchCirclesPattern = str_replace("###base_search.circles###", $circleSpans, $baseSearchCirclesPattern);
        $baseSearchCirclesPattern .= $hiddenDivs;
        return $baseSearchCirclesPattern;
    }
}

?>
