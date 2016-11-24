<?php

class ItemSearchRequest
{

  /**
   * 
   * @var string $Actor
   * @access public
   */
  public $Actor;

  /**
   * 
   * @var string $Artist
   * @access public
   */
  public $Artist;

  /**
   * 
   * @var Availability $Availability
   * @access public
   */
  public $Availability;

  /**
   * 
   * @var AudienceRating $AudienceRating
   * @access public
   */
  public $AudienceRating;

  /**
   * 
   * @var string $Author
   * @access public
   */
  public $Author;

  /**
   * 
   * @var string $Brand
   * @access public
   */
  public $Brand;

  /**
   * 
   * @var string $BrowseNode
   * @access public
   */
  public $BrowseNode;

  /**
   * 
   * @var string $Composer
   * @access public
   */
  public $Composer;

  /**
   * 
   * @var Condition $Condition
   * @access public
   */
  public $Condition;

  /**
   * 
   * @var string $Conductor
   * @access public
   */
  public $Conductor;

  /**
   * 
   * @var string $Director
   * @access public
   */
  public $Director;

  /**
   * 
   * @var int $ItemPage
   * @access public
   */
  public $ItemPage;

  /**
   * 
   * @var string $Keywords
   * @access public
   */
  public $Keywords;

  /**
   * 
   * @var string $Manufacturer
   * @access public
   */
  public $Manufacturer;

  /**
   * 
   * @var int $MaximumPrice
   * @access public
   */
  public $MaximumPrice;

  /**
   * 
   * @var string $MerchantId
   * @access public
   */
  public $MerchantId;

  /**
   * 
   * @var int $MinimumPrice
   * @access public
   */
  public $MinimumPrice;

  /**
   * 
   * @var int $MinPercentageOff
   * @access public
   */
  public $MinPercentageOff;

  /**
   * 
   * @var string $MusicLabel
   * @access public
   */
  public $MusicLabel;

  /**
   * 
   * @var string $Orchestra
   * @access public
   */
  public $Orchestra;

  /**
   * 
   * @var string $Power
   * @access public
   */
  public $Power;

  /**
   * 
   * @var string $Publisher
   * @access public
   */
  public $Publisher;

  /**
   * 
   * @var positiveIntegerOrAll $RelatedItemPage
   * @access public
   */
  public $RelatedItemPage;

  /**
   * 
   * @var string $RelationshipType
   * @access public
   */
  public $RelationshipType;

  /**
   * 
   * @var string $ResponseGroup
   * @access public
   */
  public $ResponseGroup;

  /**
   * 
   * @var string $SearchIndex
   * @access public
   */
  public $SearchIndex;

  /**
   * 
   * @var string $Sort
   * @access public
   */
  public $Sort;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @var string $ReleaseDate
   * @access public
   */
  public $ReleaseDate;

  /**
   * 
   * @var string $IncludeReviewsSummary
   * @access public
   */
  public $IncludeReviewsSummary;

  /**
   * 
   * @var int $TruncateReviewsAt
   * @access public
   */
  public $TruncateReviewsAt;

  /**
   * 
   * @param string $Actor
   * @param string $Artist
   * @param Availability $Availability
   * @param AudienceRating $AudienceRating
   * @param string $Author
   * @param string $Brand
   * @param string $BrowseNode
   * @param string $Composer
   * @param Condition $Condition
   * @param string $Conductor
   * @param string $Director
   * @param int $ItemPage
   * @param string $Keywords
   * @param string $Manufacturer
   * @param int $MaximumPrice
   * @param string $MerchantId
   * @param int $MinimumPrice
   * @param int $MinPercentageOff
   * @param string $MusicLabel
   * @param string $Orchestra
   * @param string $Power
   * @param string $Publisher
   * @param positiveIntegerOrAll $RelatedItemPage
   * @param string $RelationshipType
   * @param string $ResponseGroup
   * @param string $SearchIndex
   * @param string $Sort
   * @param string $Title
   * @param string $ReleaseDate
   * @param string $IncludeReviewsSummary
   * @param int $TruncateReviewsAt
   * @access public
   */
  public function __construct($Actor, $Artist, $Availability, $AudienceRating, $Author, $Brand, $BrowseNode, $Composer, $Condition, $Conductor, $Director, $ItemPage, $Keywords, $Manufacturer, $MaximumPrice, $MerchantId, $MinimumPrice, $MinPercentageOff, $MusicLabel, $Orchestra, $Power, $Publisher, $RelatedItemPage, $RelationshipType, $ResponseGroup, $SearchIndex, $Sort, $Title, $ReleaseDate, $IncludeReviewsSummary, $TruncateReviewsAt)
  {
    $this->Actor = $Actor;
    $this->Artist = $Artist;
    $this->Availability = $Availability;
    $this->AudienceRating = $AudienceRating;
    $this->Author = $Author;
    $this->Brand = $Brand;
    $this->BrowseNode = $BrowseNode;
    $this->Composer = $Composer;
    $this->Condition = $Condition;
    $this->Conductor = $Conductor;
    $this->Director = $Director;
    $this->ItemPage = $ItemPage;
    $this->Keywords = $Keywords;
    $this->Manufacturer = $Manufacturer;
    $this->MaximumPrice = $MaximumPrice;
    $this->MerchantId = $MerchantId;
    $this->MinimumPrice = $MinimumPrice;
    $this->MinPercentageOff = $MinPercentageOff;
    $this->MusicLabel = $MusicLabel;
    $this->Orchestra = $Orchestra;
    $this->Power = $Power;
    $this->Publisher = $Publisher;
    $this->RelatedItemPage = $RelatedItemPage;
    $this->RelationshipType = $RelationshipType;
    $this->ResponseGroup = $ResponseGroup;
    $this->SearchIndex = $SearchIndex;
    $this->Sort = $Sort;
    $this->Title = $Title;
    $this->ReleaseDate = $ReleaseDate;
    $this->IncludeReviewsSummary = $IncludeReviewsSummary;
    $this->TruncateReviewsAt = $TruncateReviewsAt;
  }

}
