<?php

class OfferSummary
{

  /**
   * 
   * @var Price $LowestNewPrice
   * @access public
   */
  public $LowestNewPrice;

  /**
   * 
   * @var Price $LowestUsedPrice
   * @access public
   */
  public $LowestUsedPrice;

  /**
   * 
   * @var Price $LowestCollectiblePrice
   * @access public
   */
  public $LowestCollectiblePrice;

  /**
   * 
   * @var Price $LowestRefurbishedPrice
   * @access public
   */
  public $LowestRefurbishedPrice;

  /**
   * 
   * @var string $TotalNew
   * @access public
   */
  public $TotalNew;

  /**
   * 
   * @var string $TotalUsed
   * @access public
   */
  public $TotalUsed;

  /**
   * 
   * @var string $TotalCollectible
   * @access public
   */
  public $TotalCollectible;

  /**
   * 
   * @var string $TotalRefurbished
   * @access public
   */
  public $TotalRefurbished;

  /**
   * 
   * @param Price $LowestNewPrice
   * @param Price $LowestUsedPrice
   * @param Price $LowestCollectiblePrice
   * @param Price $LowestRefurbishedPrice
   * @param string $TotalNew
   * @param string $TotalUsed
   * @param string $TotalCollectible
   * @param string $TotalRefurbished
   * @access public
   */
  public function __construct($LowestNewPrice, $LowestUsedPrice, $LowestCollectiblePrice, $LowestRefurbishedPrice, $TotalNew, $TotalUsed, $TotalCollectible, $TotalRefurbished)
  {
    $this->LowestNewPrice = $LowestNewPrice;
    $this->LowestUsedPrice = $LowestUsedPrice;
    $this->LowestCollectiblePrice = $LowestCollectiblePrice;
    $this->LowestRefurbishedPrice = $LowestRefurbishedPrice;
    $this->TotalNew = $TotalNew;
    $this->TotalUsed = $TotalUsed;
    $this->TotalCollectible = $TotalCollectible;
    $this->TotalRefurbished = $TotalRefurbished;
  }

}
