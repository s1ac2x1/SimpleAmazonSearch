<?php

class KeyValuePair
{

  /**
   * 
   * @var string $Key
   * @access public
   */
  public $Key;

  /**
   * 
   * @var string $Value
   * @access public
   */
  public $Value;

  /**
   * 
   * @param string $Key
   * @param string $Value
   * @access public
   */
  public function __construct($Key, $Value)
  {
    $this->Key = $Key;
    $this->Value = $Value;
  }

}
