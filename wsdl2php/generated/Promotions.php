<?php

class Promotions
{

  /**
   * 
   * @var Promotion $Promotion
   * @access public
   */
  public $Promotion;

  /**
   * 
   * @param Promotion $Promotion
   * @access public
   */
  public function __construct($Promotion)
  {
    $this->Promotion = $Promotion;
  }

}
