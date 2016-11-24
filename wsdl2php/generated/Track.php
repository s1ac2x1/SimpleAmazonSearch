<?php

class Track
{

  /**
   * 
   * @var string $_
   * @access public
   */
  public $_;

  /**
   * 
   * @var int $Number
   * @access public
   */
  public $Number;

  /**
   * 
   * @param string $_
   * @param int $Number
   * @access public
   */
  public function __construct($_, $Number)
  {
    $this->_ = $_;
    $this->Number = $Number;
  }

}
