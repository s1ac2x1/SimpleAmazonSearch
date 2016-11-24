<?php

class SavedForLaterItems
{

  /**
   * 
   * @var Price $SubTotal
   * @access public
   */
  public $SubTotal;

  /**
   * 
   * @var CartItem $SavedForLaterItem
   * @access public
   */
  public $SavedForLaterItem;

  /**
   * 
   * @param Price $SubTotal
   * @param CartItem $SavedForLaterItem
   * @access public
   */
  public function __construct($SubTotal, $SavedForLaterItem)
  {
    $this->SubTotal = $SubTotal;
    $this->SavedForLaterItem = $SavedForLaterItem;
  }

}
