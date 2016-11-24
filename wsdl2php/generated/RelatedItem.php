<?php

class RelatedItem
{

  /**
   * 
   * @var Item $Item
   * @access public
   */
  public $Item;

  /**
   * 
   * @param Item $Item
   * @access public
   */
  public function __construct($Item)
  {
    $this->Item = $Item;
  }

}
