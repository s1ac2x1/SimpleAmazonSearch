<?php

class Price
{

  /**
   * 
   * @var int $Amount
   * @access public
   */
  public $Amount;

  /**
   * 
   * @var string $CurrencyCode
   * @access public
   */
  public $CurrencyCode;

  /**
   * 
   * @var string $FormattedPrice
   * @access public
   */
  public $FormattedPrice;

  /**
   * 
   * @param int $Amount
   * @param string $CurrencyCode
   * @param string $FormattedPrice
   * @access public
   */
  public function __construct($Amount, $CurrencyCode, $FormattedPrice)
  {
    $this->Amount = $Amount;
    $this->CurrencyCode = $CurrencyCode;
    $this->FormattedPrice = $FormattedPrice;
  }

}
