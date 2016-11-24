<?php

class CartItem
{

  /**
   * 
   * @var string $CartItemId
   * @access public
   */
  public $CartItemId;

  /**
   * 
   * @var string $ASIN
   * @access public
   */
  public $ASIN;

  /**
   * 
   * @var string $SellerNickname
   * @access public
   */
  public $SellerNickname;

  /**
   * 
   * @var string $Quantity
   * @access public
   */
  public $Quantity;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @var string $ProductGroup
   * @access public
   */
  public $ProductGroup;

  /**
   * 
   * @var MetaData $MetaData
   * @access public
   */
  public $MetaData;

  /**
   * 
   * @var Price $Price
   * @access public
   */
  public $Price;

  /**
   * 
   * @var Price $ItemTotal
   * @access public
   */
  public $ItemTotal;

  /**
   * 
   * @param string $CartItemId
   * @param string $ASIN
   * @param string $SellerNickname
   * @param string $Quantity
   * @param string $Title
   * @param string $ProductGroup
   * @param MetaData $MetaData
   * @param Price $Price
   * @param Price $ItemTotal
   * @access public
   */
  public function __construct($CartItemId, $ASIN, $SellerNickname, $Quantity, $Title, $ProductGroup, $MetaData, $Price, $ItemTotal)
  {
    $this->CartItemId = $CartItemId;
    $this->ASIN = $ASIN;
    $this->SellerNickname = $SellerNickname;
    $this->Quantity = $Quantity;
    $this->Title = $Title;
    $this->ProductGroup = $ProductGroup;
    $this->MetaData = $MetaData;
    $this->Price = $Price;
    $this->ItemTotal = $ItemTotal;
  }

}
