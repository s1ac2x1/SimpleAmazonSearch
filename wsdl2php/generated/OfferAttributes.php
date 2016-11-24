<?php

class OfferAttributes
{

  /**
   * 
   * @var string $Condition
   * @access public
   */
  public $Condition;

  /**
   * 
   * @param string $Condition
   * @access public
   */
  public function __construct($Condition)
  {
    $this->Condition = $Condition;
  }

}
