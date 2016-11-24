<?php

class Image
{

  /**
   * 
   * @var string $URL
   * @access public
   */
  public $URL;

  /**
   * 
   * @var DecimalWithUnits $Height
   * @access public
   */
  public $Height;

  /**
   * 
   * @var DecimalWithUnits $Width
   * @access public
   */
  public $Width;

  /**
   * 
   * @var string $IsVerified
   * @access public
   */
  public $IsVerified;

  /**
   * 
   * @param string $URL
   * @param DecimalWithUnits $Height
   * @param DecimalWithUnits $Width
   * @param string $IsVerified
   * @access public
   */
  public function __construct($URL, $Height, $Width, $IsVerified)
  {
    $this->URL = $URL;
    $this->Height = $Height;
    $this->Width = $Width;
    $this->IsVerified = $IsVerified;
  }

}
