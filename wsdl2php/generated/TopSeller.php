<?php

class TopSeller
{

  /**
   * 
   * @var string $ASIN
   * @access public
   */
  public $ASIN;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @param string $ASIN
   * @param string $Title
   * @access public
   */
  public function __construct($ASIN, $Title)
  {
    $this->ASIN = $ASIN;
    $this->Title = $Title;
  }

}
