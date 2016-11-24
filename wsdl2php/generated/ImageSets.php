<?php

class ImageSets
{

  /**
   * 
   * @var ImageSet $ImageSet
   * @access public
   */
  public $ImageSet;

  /**
   * 
   * @param ImageSet $ImageSet
   * @access public
   */
  public function __construct($ImageSet)
  {
    $this->ImageSet = $ImageSet;
  }

}
