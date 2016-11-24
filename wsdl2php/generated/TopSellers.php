<?php

class TopSellers
{

  /**
   * 
   * @var TopSeller $TopSeller
   * @access public
   */
  public $TopSeller;

  /**
   * 
   * @param TopSeller $TopSeller
   * @access public
   */
  public function __construct($TopSeller)
  {
    $this->TopSeller = $TopSeller;
  }

}
