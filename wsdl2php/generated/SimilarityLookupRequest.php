<?php

class SimilarityLookupRequest
{

  /**
   * 
   * @var Condition $Condition
   * @access public
   */
  public $Condition;

  /**
   * 
   * @var string $ItemId
   * @access public
   */
  public $ItemId;

  /**
   * 
   * @var string $MerchantId
   * @access public
   */
  public $MerchantId;

  /**
   * 
   * @var string $ResponseGroup
   * @access public
   */
  public $ResponseGroup;

  /**
   * 
   * @var SimilarityType $SimilarityType
   * @access public
   */
  public $SimilarityType;

  /**
   * 
   * @param Condition $Condition
   * @param string $ItemId
   * @param string $MerchantId
   * @param string $ResponseGroup
   * @param SimilarityType $SimilarityType
   * @access public
   */
  public function __construct($Condition, $ItemId, $MerchantId, $ResponseGroup, $SimilarityType)
  {
    $this->Condition = $Condition;
    $this->ItemId = $ItemId;
    $this->MerchantId = $MerchantId;
    $this->ResponseGroup = $ResponseGroup;
    $this->SimilarityType = $SimilarityType;
  }

}
