<?php

class ItemLookupRequest
{

  /**
   * 
   * @var Condition $Condition
   * @access public
   */
  public $Condition;

  /**
   * 
   * @var IdType $IdType
   * @access public
   */
  public $IdType;

  /**
   * 
   * @var string $MerchantId
   * @access public
   */
  public $MerchantId;

  /**
   * 
   * @var string $ItemId
   * @access public
   */
  public $ItemId;

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
   * @var positiveIntegerOrAll $VariationPage
   * @access public
   */
  public $VariationPage;

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
   * @param Condition $Condition
   * @param IdType $IdType
   * @param string $MerchantId
   * @param string $ItemId
   * @param string $ResponseGroup
   * @param string $SearchIndex
   * @param positiveIntegerOrAll $VariationPage
   * @param positiveIntegerOrAll $RelatedItemPage
   * @param string $RelationshipType
   * @param string $IncludeReviewsSummary
   * @param int $TruncateReviewsAt
   * @access public
   */
  public function __construct($Condition, $IdType, $MerchantId, $ItemId, $ResponseGroup, $SearchIndex, $VariationPage, $RelatedItemPage, $RelationshipType, $IncludeReviewsSummary, $TruncateReviewsAt)
  {
    $this->Condition = $Condition;
    $this->IdType = $IdType;
    $this->MerchantId = $MerchantId;
    $this->ItemId = $ItemId;
    $this->ResponseGroup = $ResponseGroup;
    $this->SearchIndex = $SearchIndex;
    $this->VariationPage = $VariationPage;
    $this->RelatedItemPage = $RelatedItemPage;
    $this->RelationshipType = $RelationshipType;
    $this->IncludeReviewsSummary = $IncludeReviewsSummary;
    $this->TruncateReviewsAt = $TruncateReviewsAt;
  }

}
