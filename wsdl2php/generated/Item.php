<?php

class Item
{

  /**
   * 
   * @var string $ASIN
   * @access public
   */
  public $ASIN;

  /**
   * 
   * @var string $ParentASIN
   * @access public
   */
  public $ParentASIN;

  /**
   * 
   * @var Errors $Errors
   * @access public
   */
  public $Errors;

  /**
   * 
   * @var string $DetailPageURL
   * @access public
   */
  public $DetailPageURL;

  /**
   * 
   * @var ItemLinks $ItemLinks
   * @access public
   */
  public $ItemLinks;

  /**
   * 
   * @var string $SalesRank
   * @access public
   */
  public $SalesRank;

  /**
   * 
   * @var Image $SmallImage
   * @access public
   */
  public $SmallImage;

  /**
   * 
   * @var Image $MediumImage
   * @access public
   */
  public $MediumImage;

  /**
   * 
   * @var Image $LargeImage
   * @access public
   */
  public $LargeImage;

  /**
   * 
   * @var ImageSets $ImageSets
   * @access public
   */
  public $ImageSets;

  /**
   * 
   * @var ItemAttributes $ItemAttributes
   * @access public
   */
  public $ItemAttributes;

  /**
   * 
   * @var VariationAttributes $VariationAttributes
   * @access public
   */
  public $VariationAttributes;

  /**
   * 
   * @var RelatedItems $RelatedItems
   * @access public
   */
  public $RelatedItems;

  /**
   * 
   * @var Collections $Collections
   * @access public
   */
  public $Collections;

  /**
   * 
   * @var Subjects $Subjects
   * @access public
   */
  public $Subjects;

  /**
   * 
   * @var OfferSummary $OfferSummary
   * @access public
   */
  public $OfferSummary;

  /**
   * 
   * @var Offers $Offers
   * @access public
   */
  public $Offers;

  /**
   * 
   * @var VariationSummary $VariationSummary
   * @access public
   */
  public $VariationSummary;

  /**
   * 
   * @var Variations $Variations
   * @access public
   */
  public $Variations;

  /**
   * 
   * @var CustomerReviews $CustomerReviews
   * @access public
   */
  public $CustomerReviews;

  /**
   * 
   * @var EditorialReviews $EditorialReviews
   * @access public
   */
  public $EditorialReviews;

  /**
   * 
   * @var SimilarProducts $SimilarProducts
   * @access public
   */
  public $SimilarProducts;

  /**
   * 
   * @var Accessories $Accessories
   * @access public
   */
  public $Accessories;

  /**
   * 
   * @var Tracks $Tracks
   * @access public
   */
  public $Tracks;

  /**
   * 
   * @var BrowseNodes $BrowseNodes
   * @access public
   */
  public $BrowseNodes;

  /**
   * 
   * @var AlternateVersions $AlternateVersions
   * @access public
   */
  public $AlternateVersions;

  /**
   * 
   * @param string $ASIN
   * @param string $ParentASIN
   * @param Errors $Errors
   * @param string $DetailPageURL
   * @param ItemLinks $ItemLinks
   * @param string $SalesRank
   * @param Image $SmallImage
   * @param Image $MediumImage
   * @param Image $LargeImage
   * @param ImageSets $ImageSets
   * @param ItemAttributes $ItemAttributes
   * @param VariationAttributes $VariationAttributes
   * @param RelatedItems $RelatedItems
   * @param Collections $Collections
   * @param Subjects $Subjects
   * @param OfferSummary $OfferSummary
   * @param Offers $Offers
   * @param VariationSummary $VariationSummary
   * @param Variations $Variations
   * @param CustomerReviews $CustomerReviews
   * @param EditorialReviews $EditorialReviews
   * @param SimilarProducts $SimilarProducts
   * @param Accessories $Accessories
   * @param Tracks $Tracks
   * @param BrowseNodes $BrowseNodes
   * @param AlternateVersions $AlternateVersions
   * @access public
   */
  public function __construct($ASIN, $ParentASIN, $Errors, $DetailPageURL, $ItemLinks, $SalesRank, $SmallImage, $MediumImage, $LargeImage, $ImageSets, $ItemAttributes, $VariationAttributes, $RelatedItems, $Collections, $Subjects, $OfferSummary, $Offers, $VariationSummary, $Variations, $CustomerReviews, $EditorialReviews, $SimilarProducts, $Accessories, $Tracks, $BrowseNodes, $AlternateVersions)
  {
    $this->ASIN = $ASIN;
    $this->ParentASIN = $ParentASIN;
    $this->Errors = $Errors;
    $this->DetailPageURL = $DetailPageURL;
    $this->ItemLinks = $ItemLinks;
    $this->SalesRank = $SalesRank;
    $this->SmallImage = $SmallImage;
    $this->MediumImage = $MediumImage;
    $this->LargeImage = $LargeImage;
    $this->ImageSets = $ImageSets;
    $this->ItemAttributes = $ItemAttributes;
    $this->VariationAttributes = $VariationAttributes;
    $this->RelatedItems = $RelatedItems;
    $this->Collections = $Collections;
    $this->Subjects = $Subjects;
    $this->OfferSummary = $OfferSummary;
    $this->Offers = $Offers;
    $this->VariationSummary = $VariationSummary;
    $this->Variations = $Variations;
    $this->CustomerReviews = $CustomerReviews;
    $this->EditorialReviews = $EditorialReviews;
    $this->SimilarProducts = $SimilarProducts;
    $this->Accessories = $Accessories;
    $this->Tracks = $Tracks;
    $this->BrowseNodes = $BrowseNodes;
    $this->AlternateVersions = $AlternateVersions;
  }

}
