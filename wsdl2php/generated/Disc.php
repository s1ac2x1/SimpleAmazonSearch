<?php

class Disc
{

  /**
   * 
   * @var Track $Track
   * @access public
   */
  public $Track;

  /**
   * 
   * @var int $Number
   * @access public
   */
  public $Number;

  /**
   * 
   * @param Track $Track
   * @param int $Number
   * @access public
   */
  public function __construct($Track, $Number)
  {
    $this->Track = $Track;
    $this->Number = $Number;
  }

}
