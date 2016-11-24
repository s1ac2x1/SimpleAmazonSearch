<?php

class CartAddRequest
{

  /**
   * 
   * @var string $CartId
   * @access public
   */
  public $CartId;

  /**
   * 
   * @var string $HMAC
   * @access public
   */
  public $HMAC;

  /**
   * 
   * @var string $MergeCart
   * @access public
   */
  public $MergeCart;

  /**
   * 
   * @var Items $Items
   * @access public
   */
  public $Items;

  /**
   * 
   * @var string $ResponseGroup
   * @access public
   */
  public $ResponseGroup;

  /**
   * 
   * @param string $CartId
   * @param string $HMAC
   * @param string $MergeCart
   * @param Items $Items
   * @param string $ResponseGroup
   * @access public
   */
  public function __construct($CartId, $HMAC, $MergeCart, $Items, $ResponseGroup)
  {
    $this->CartId = $CartId;
    $this->HMAC = $HMAC;
    $this->MergeCart = $MergeCart;
    $this->Items = $Items;
    $this->ResponseGroup = $ResponseGroup;
  }

}
