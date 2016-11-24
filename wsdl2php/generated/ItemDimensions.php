<?php

class ItemDimensions
{

  /**
   * 
   * @var DecimalWithUnits $Height
   * @access public
   */
  public $Height;

  /**
   * 
   * @var DecimalWithUnits $Length
   * @access public
   */
  public $Length;

  /**
   * 
   * @var DecimalWithUnits $Weight
   * @access public
   */
  public $Weight;

  /**
   * 
   * @var DecimalWithUnits $Width
   * @access public
   */
  public $Width;

  /**
   * 
   * @param DecimalWithUnits $Height
   * @param DecimalWithUnits $Length
   * @param DecimalWithUnits $Weight
   * @param DecimalWithUnits $Width
   * @access public
   */
  public function __construct($Height, $Length, $Weight, $Width)
  {
    $this->Height = $Height;
    $this->Length = $Length;
    $this->Weight = $Weight;
    $this->Width = $Width;
  }

}
