<?php

class Errors
{

  /**
   * 
   * @var Error $Error
   * @access public
   */
  public $Error;

  /**
   * 
   * @param Error $Error
   * @access public
   */
  public function __construct($Error)
  {
    $this->Error = $Error;
  }

}
