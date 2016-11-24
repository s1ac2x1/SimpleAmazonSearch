<?php

class Tracks
{

  /**
   * 
   * @var Disc $Disc
   * @access public
   */
  public $Disc;

  /**
   * 
   * @param Disc $Disc
   * @access public
   */
  public function __construct($Disc)
  {
    $this->Disc = $Disc;
  }

}
