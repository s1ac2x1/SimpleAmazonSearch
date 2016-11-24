<?php

class Properties
{

  /**
   * 
   * @var Property $Property
   * @access public
   */
  public $Property;

  /**
   * 
   * @param Property $Property
   * @access public
   */
  public function __construct($Property)
  {
    $this->Property = $Property;
  }

}
