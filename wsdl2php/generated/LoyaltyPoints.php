<?php

class LoyaltyPoints
{

  /**
   * 
   * @var int $Points
   * @access public
   */
  public $Points;

  /**
   * 
   * @var Price $TypicalRedemptionValue
   * @access public
   */
  public $TypicalRedemptionValue;

  /**
   * 
   * @param int $Points
   * @param Price $TypicalRedemptionValue
   * @access public
   */
  public function __construct($Points, $TypicalRedemptionValue)
  {
    $this->Points = $Points;
    $this->TypicalRedemptionValue = $TypicalRedemptionValue;
  }

}
