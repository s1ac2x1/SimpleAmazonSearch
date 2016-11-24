<?php

class AvailabilityAttributes
{

  /**
   * 
   * @var string $AvailabilityType
   * @access public
   */
  public $AvailabilityType;

  /**
   * 
   * @var boolean $IsPreorder
   * @access public
   */
  public $IsPreorder;

  /**
   * 
   * @var int $MinimumHours
   * @access public
   */
  public $MinimumHours;

  /**
   * 
   * @var int $MaximumHours
   * @access public
   */
  public $MaximumHours;

  /**
   * 
   * @param string $AvailabilityType
   * @param boolean $IsPreorder
   * @param int $MinimumHours
   * @param int $MaximumHours
   * @access public
   */
  public function __construct($AvailabilityType, $IsPreorder, $MinimumHours, $MaximumHours)
  {
    $this->AvailabilityType = $AvailabilityType;
    $this->IsPreorder = $IsPreorder;
    $this->MinimumHours = $MinimumHours;
    $this->MaximumHours = $MaximumHours;
  }

}
