<?php

class Language
{

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var string $Type
   * @access public
   */
  public $Type;

  /**
   * 
   * @var string $AudioFormat
   * @access public
   */
  public $AudioFormat;

  /**
   * 
   * @param string $Name
   * @param string $Type
   * @param string $AudioFormat
   * @access public
   */
  public function __construct($Name, $Type, $AudioFormat)
  {
    $this->Name = $Name;
    $this->Type = $Type;
    $this->AudioFormat = $AudioFormat;
  }

}
