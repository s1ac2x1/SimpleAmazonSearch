<?php

class Error
{

  /**
   * 
   * @var string $Code
   * @access public
   */
  public $Code;

  /**
   * 
   * @var string $Message
   * @access public
   */
  public $Message;

  /**
   * 
   * @param string $Code
   * @param string $Message
   * @access public
   */
  public function __construct($Code, $Message)
  {
    $this->Code = $Code;
    $this->Message = $Message;
  }

}
