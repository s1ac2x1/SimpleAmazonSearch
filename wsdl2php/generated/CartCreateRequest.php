<?php

class CartCreateRequest
{

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
   * @param string $MergeCart
   * @param Items $Items
   * @param string $ResponseGroup
   * @access public
   */
  public function __construct($MergeCart, $Items, $ResponseGroup)
  {
    $this->MergeCart = $MergeCart;
    $this->Items = $Items;
    $this->ResponseGroup = $ResponseGroup;
  }

}
