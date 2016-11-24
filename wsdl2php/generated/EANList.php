<?php

class EANList
{

  /**
   * 
   * @var string $EANListElement
   * @access public
   */
  public $EANListElement;

  /**
   * 
   * @param string $EANListElement
   * @access public
   */
  public function __construct($EANListElement)
  {
    $this->EANListElement = $EANListElement;
  }

}
