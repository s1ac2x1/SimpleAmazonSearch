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

}
