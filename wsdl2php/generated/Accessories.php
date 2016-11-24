<?php

class Accessories
{

  /**
   * 
   * @var Accessory $Accessory
   * @access public
   */
  public $Accessory;

  /**
   * 
   * @param Accessory $Accessory
   * @access public
   */
  public function __construct($Accessory)
  {
    $this->Accessory = $Accessory;
  }

}
