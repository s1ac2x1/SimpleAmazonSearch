<?php

class ItemLinks
{

  /**
   * 
   * @var ItemLink $ItemLink
   * @access public
   */
  public $ItemLink;

  /**
   * 
   * @param ItemLink $ItemLink
   * @access public
   */
  public function __construct($ItemLink)
  {
    $this->ItemLink = $ItemLink;
  }

}
