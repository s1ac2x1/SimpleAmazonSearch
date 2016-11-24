<?php

class CollectionSummary
{

  /**
   * 
   * @var Price $LowestListPrice
   * @access public
   */
  public $LowestListPrice;

  /**
   * 
   * @var Price $HighestListPrice
   * @access public
   */
  public $HighestListPrice;

  /**
   * 
   * @var Price $LowestSalePrice
   * @access public
   */
  public $LowestSalePrice;

  /**
   * 
   * @var Price $HighestSalePrice
   * @access public
   */
  public $HighestSalePrice;

  /**
   * 
   * @param Price $LowestListPrice
   * @param Price $HighestListPrice
   * @param Price $LowestSalePrice
   * @param Price $HighestSalePrice
   * @access public
   */
  public function __construct($LowestListPrice, $HighestListPrice, $LowestSalePrice, $HighestSalePrice)
  {
    $this->LowestListPrice = $LowestListPrice;
    $this->HighestListPrice = $HighestListPrice;
    $this->LowestSalePrice = $LowestSalePrice;
    $this->HighestSalePrice = $HighestSalePrice;
  }

}
