<?php

class CartItems
{

  /**
   * 
   * @var Price $SubTotal
   * @access public
   */
  public $SubTotal;

  /**
   * 
   * @var CartItem $CartItem
   * @access public
   */
  public $CartItem;

  /**
   * 
   * @param Price $SubTotal
   * @param CartItem $CartItem
   * @access public
   */
  public function __construct($SubTotal, $CartItem)
  {
    $this->SubTotal = $SubTotal;
    $this->CartItem = $CartItem;
  }

}
