<?php

class NewReleases
{

  /**
   * 
   * @var NewRelease $NewRelease
   * @access public
   */
  public $NewRelease;

  /**
   * 
   * @param NewRelease $NewRelease
   * @access public
   */
  public function __construct($NewRelease)
  {
    $this->NewRelease = $NewRelease;
  }

}
