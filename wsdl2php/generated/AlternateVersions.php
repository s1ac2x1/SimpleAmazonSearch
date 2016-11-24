<?php

class AlternateVersions
{

  /**
   * 
   * @var AlternateVersion $AlternateVersion
   * @access public
   */
  public $AlternateVersion;

  /**
   * 
   * @param AlternateVersion $AlternateVersion
   * @access public
   */
  public function __construct($AlternateVersion)
  {
    $this->AlternateVersion = $AlternateVersion;
  }

}
