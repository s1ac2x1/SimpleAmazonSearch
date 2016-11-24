<?php

class Promotion
{

  /**
   * 
   * @var Summary $Summary
   * @access public
   */
  public $Summary;

  /**
   * 
   * @param Summary $Summary
   * @access public
   */
  public function __construct($Summary)
  {
    $this->Summary = $Summary;
  }

}
