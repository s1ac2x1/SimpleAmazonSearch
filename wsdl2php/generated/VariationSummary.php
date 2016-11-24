<?php

class VariationSummary
{

  /**
   * 
   * @var Price $LowestPrice
   * @access public
   */
  public $LowestPrice;

  /**
   * 
   * @var Price $HighestPrice
   * @access public
   */
  public $HighestPrice;

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
   * @param Price $LowestPrice
   * @param Price $HighestPrice
   * @param Price $LowestSalePrice
   * @param Price $HighestSalePrice
   * @access public
   */
  public function __construct($LowestPrice, $HighestPrice, $LowestSalePrice, $HighestSalePrice)
  {
    $this->LowestPrice = $LowestPrice;
    $this->HighestPrice = $HighestPrice;
    $this->LowestSalePrice = $LowestSalePrice;
    $this->HighestSalePrice = $HighestSalePrice;
  }

}
