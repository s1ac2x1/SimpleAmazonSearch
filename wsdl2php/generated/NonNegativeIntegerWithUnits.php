<?php

class NonNegativeIntegerWithUnits
{

  /**
   * 
   * @var int $_
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
   * @param int $_
   * @param string $Units
   * @access public
   */
  public function __construct($_, $Units)
  {
    $this->_ = $_;
    $this->Units = $Units;
  }

}
