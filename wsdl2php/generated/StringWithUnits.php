<?php

class StringWithUnits
{

  /**
   * 
   * @var string $_
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
   * @param string $_
   * @param string $Units
   * @access public
   */
  public function __construct($_, $Units)
  {
    $this->_ = $_;
    $this->Units = $Units;
  }

}
