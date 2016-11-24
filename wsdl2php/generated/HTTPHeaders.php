<?php

class HTTPHeaders
{

  /**
   * 
   * @var Header $Header
   * @access public
   */
  public $Header;

  /**
   * 
   * @param Header $Header
   * @access public
   */
  public function __construct($Header)
  {
    $this->Header = $Header;
  }

}
