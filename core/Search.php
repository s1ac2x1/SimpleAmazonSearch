<?php
require_once(dirname(__FILE__) . "/../core/WSRequest.php");
require_once(dirname(__FILE__) . "/../wrappers/ImageASIN.php");
require_once(dirname(__FILE__) . "/../wrappers/BestItemByPrice.php");
require_once(dirname(__FILE__) . "/../wrappers/ASINPrice.php");
require_once(dirname(__FILE__) . "/../data/Image.php");
require_once(dirname(__FILE__) . "/../core/Constructor.php");

class Search
{

    private $AccessKey;
    private $AssociateTag;
    private $SecretKey;

    public function __construct($AccessKey = "", $AssociateTag = "", $SecretKey = "")
    {
        if ($AccessKey != null && $AccessKey != "") {
            $this->AccessKey = $AccessKey;
        } else {
            $this->AccessKey = "";
        }
        if ($AssociateTag != null && $AssociateTag != "") {
            $this->AssociateTag = $AssociateTag;
        } else {
            $this->AssociateTag = "";
        }
        if ($SecretKey != null && $SecretKey != "") {
            $this->SecretKey = $SecretKey;
        } else {
            $this->SecretKey = "";
        }
    }

    // return wrapper contains Image and ASIN
    public function findItemImages($keyword, $size)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemSearch',
            'SearchIndex' => 'All',
            'Keywords' => $keyword,
            'ResponseGroup' => 'Images',
            'Availability' => 'Available',
            'Condition' => 'All'
        );
        $wsRequest->configure($configuration);
        $wsRequest->getSignedUrl();
        $xml = $wsRequest->xml();
        $imageASINs = array();
        foreach ($xml->Items->Item as $item) {
            $Image = new Image();
            if ($size == 'big') {
                $Image->Height = $item->LargeImage->Height;
                $Image->IsVerified = $item->LargeImage->IsVerified;
                $Image->URL = $item->LargeImage->URL;
                $Image->Width = $item->LargeImage->Width;
            }
            if ($size == 'medium') {
                $Image->Height = $item->MediumImage->Height;
                $Image->IsVerified = $item->MediumImage->IsVerified;
                $Image->URL = $item->MediumImage->URL;
                $Image->Width = $item->MediumImage->Width;
            }
            if ($size == 'small') {
                $Image->Height = $item->SmallImage->Height;
                $Image->IsVerified = $item->SmallImage->IsVerified;
                $Image->URL = $item->SmallImage->URL;
                $Image->Width = $item->SmallImage->Width;
            }
            $imageASIN = new ImageASIN($Image, $item->ASIN);
            array_push($imageASINs, $imageASIN);
        }
        return $imageASINs;
    }

    public function findAllASINS($keyword)
    {
        $ASINs = array();
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemSearch',
            'ResponseGroup' => 'Small',
            'Keywords' => $keyword,
            'Condition' => 'All',
            'SearchIndex' => 'All'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(false);
        if ($xml->Items) {
            foreach ($xml->Items->Item as $item_) {
                array_push($ASINs, $item_->ASIN);
            }
        }
        return $ASINs;
    }

    public function findASINFromKeyword($keyword)
    {
        $ASIN = null;
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemSearch',
            'ResponseGroup' => 'Small',
            'Keywords' => $keyword,
            'Condition' => 'All',
            'SearchIndex' => 'All'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(false);
        if ($xml->Items) {
            $ASIN = $xml->Items->Item[0]->ASIN;
        }
        return $ASIN;
    }

    public function findAllAccessories($keyword)
    {
        $result = array();
        $allASINsByKeyword = $this->findAllASINS($keyword);
        foreach ($allASINsByKeyword as $ASIN) {
            $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
            $configuration = array(
                'Operation' => 'ItemLookup',
                'IdType' => 'ASIN',
                'ItemId' => $ASIN,
                'ResponseGroup' => 'Accessories'
            );
            $wsRequest->configure($configuration);
            $xml = $wsRequest->xml(false);
            if ($xml->Items->Item[0]->Accessories) {
                foreach ($xml->Items->Item[0]->Accessories->Accessory as $accessory) {
                    array_push($result, $accessory->ASIN);
                }
            }
        }
        return $result;
    }


    public function loadItemByASIN($ASIN)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemLookup',
            'ItemId' => $ASIN,
            'IdType' => 'ASIN',
            'ResponseGroup' => 'Large'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(false);
        $constructor = new Constructor($xml);
        $ItemSearchResponse = $constructor->getItemSearchResponse();
    }

    public function findLowestPrice($ASIN)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemLookup',
            'ItemId' => $ASIN,
            'IdType' => 'ASIN',
            'ResponseGroup' => 'OfferSummary'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(false);
        return $xml->Items->Item[0]->OfferSummary->LowestNewPrice->Amount;
    }

    public function loadLargeXMLFromASIN($ASIN)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemLookup',
            'ItemId' => $ASIN,
            'IdType' => 'ASIN',
            'ResponseGroup' => 'Offers'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(true);
        return $xml;
    }

    private function search_($array, $key, $value)
    {
        $results = array();
        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value)
                $results[] = $array;
            foreach ($array as $subarray)
                $results = array_merge($results, $this->search_($subarray, $key, $value));
        }
        return $results;
    }

    public function findSearchIndex($ASIN)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemLookup',
            'ItemId' => $ASIN,
            'IdType' => 'ASIN',
            'ResponseGroup' => 'Large'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(false);
        $arr = json_decode(json_encode((array)$xml->Items->Item[0]->BrowseNodes), 1);
        $searchIndex = "";
        $indexes = array('All', 'Apparel', 'Appliances', 'ArtsAndCrafts', 'Automotive', 'BabyBeauty', 'Blended', 'Books', 'Classical', 'Collectibles', 'DigitalMusic', 'Grocery', 'DVD', 'Electronics', 'HealthPersonalCare', 'HomeGarden', 'Industrial', 'Jewelry', 'KindleStore', 'Kitchen', 'LawnAndGarden', 'Magazines', 'Marketplace', 'Merchants', 'Miscellaneous', 'MobileApps', 'MP3Downloads', 'Music', 'MusicalInstruments', 'MusicTracks', 'OfficeProducts', 'OutdoorLiving', 'PCHardware', 'PetSupplies', 'Photo', 'Shoes', 'Software', 'SportingGoods', 'Tools', 'Toys', 'UnboxVideo', 'VHS', 'Video', 'VideoGames', 'Watches', 'Wireless', 'WirelessAccessories');
        foreach ($indexes as $index) {
            if (count($this->search_($arr, 'Name', $index)) > 0) {
                return $index;
            }
        }
    }

    public function loadAllItemsFromRequest($keyword)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemSearch',
            'Keywords' => $keyword,
            'SearchIndex' => 'All',
            'ResponseGroup' => 'Offers'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(false);
        $isFound = false;
        $asinPriceArray = array();
        if ($xml->Items) {
            $minPrice = $xml->Items->Item[0]->OfferListing->Price->Amount;
            $asinWithMinPrice = "nope";
            $isFound = true;
            $count = 0;
            foreach ($xml->Items->Item as $item) {
                if ($count == 5) return $asinPriceArray;
                if (!isset($item->Offers->Offer[0]->OfferListing->Price->Amount) || trim($item->Offers->Offer[0]->OfferListing->Price->Amount) === '') {
                    continue;
                } else {
                    $asinPrice = new ASINPrice();
                    $asinPrice->ASIN = $item->ASIN;
                    $asinPrice->PRICE = $item->Offers->Offer[0]->OfferListing->Price->Amount;
                    echo $count . ". " . $asinPrice->ASIN . " - " . $asinPrice->PRICE . "<br>";
                    array_push($asinPriceArray, $asinPrice);
                }
                $count++;
            }
        }
    }

    public function cmp($a, $b)
    {
        if ($a->PRICE == $b->PRICE) {
            return 0;
        }
        return ($a->PRICE < $b->PRICE) ? -1 : 1;
    }

    public function findTheCheapest($keyword)
    {
        $arr = $this->loadAllItemsFromRequest($keyword);
        usort($arr, 'cmp');
        $cheapest = $arr[0];
        sleep(1);
    }

    public function getItemSearchResponseXML($keyword, $index)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemSearch',
            'Keywords' => $keyword,
            'SearchIndex' => $index,
            'ResponseGroup' => 'Large'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(true);
        return $xml;
        //$constructor = new Constructor($xml);
        //return $constructor->getItemSearchResponse();
    }

    public function findItemLink($asin)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemLookup',
            'ItemId' => $asin,
            'IdType' => 'ASIN',
            'ResponseGroup' => 'Small'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml(false);
        return $xml->Items->Item->DetailPageURL;
    }

    public function loadVariantsRawXML($asin)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemLookup',
            'Condition' => 'All',
            'ItemId' => $asin,
            'IdType' => 'ASIN',
            'ResponseGroup' => 'VariationMatrix'
        );
        $wsRequest->configure($configuration);
        return $wsRequest->xml(false);
    }

    public function loadTopSellersRawXML($id)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'BrowseNodeLookup',
            'BrowseNodeId' => $id,
            'ResponseGroup' => 'TopSellers'
        );
        $wsRequest->configure($configuration);
        return $wsRequest->xml(false);
    }

    public function loadItemRawXML($asin)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemLookup',
            'ItemId' => $asin,
            'IdType' => 'ASIN',
            'ResponseGroup' => 'Large'
        );
        $wsRequest->configure($configuration);
        return $wsRequest->xml(false);
    }

    public function checkUsersAccountData()
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'ItemSearch',
            'Keywords' => "canon",
            'SearchIndex' => 'All',
            'ResponseGroup' => 'Small'
        );
        $wsRequest->configure($configuration);
        return $wsRequest->xml(true);
    }

    public function loadNodesRawXML($id, $group)
    {
        $wsRequest = new WSRequest($this->AccessKey, $this->AssociateTag, $this->SecretKey);
        $configuration = array(
            'Operation' => 'BrowseNodeLookup',
            'BrowseNodeId' => $id,
            'ResponseGroup' => $group
        );
        $wsRequest->configure($configuration);
        return $wsRequest->xml(false);
    }


}

?>