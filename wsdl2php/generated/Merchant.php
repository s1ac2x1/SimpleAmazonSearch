<?php

class Merchant
{

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @param string $Name
   * @access public
   */
  public function __construct($Name)
  {
    $this->Name = $Name;
  }

}
