<?php

class DecimalWithUnits
{

  /**
   * 
   * @var float $_
   * @access public
   */
  public $_;

  /**
   * 
   * @var string $Units
   * @access public
   */
  public $Units;

  /**
   * 
   * @param float $_
   * @param string $Units
   * @access public
   */
  public function __construct($_, $Units)
  {
    $this->_ = $_;
    $this->Units = $Units;
  }

}
