<?php

class Languages
{

  /**
   * 
   * @var Language $Language
   * @access public
   */
  public $Language;

  /**
   * 
   * @param Language $Language
   * @access public
   */
  public function __construct($Language)
  {
    $this->Language = $Language;
  }

}
