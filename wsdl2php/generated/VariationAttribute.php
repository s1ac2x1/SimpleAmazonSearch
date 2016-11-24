<?php

class VariationAttribute
{

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var string $Value
   * @access public
   */
  public $Value;

  /**
   * 
   * @param string $Name
   * @param string $Value
   * @access public
   */
  public function __construct($Name, $Value)
  {
    $this->Name = $Name;
    $this->Value = $Value;
  }

}
