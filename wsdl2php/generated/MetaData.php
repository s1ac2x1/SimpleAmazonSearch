<?php

class MetaData
{

  /**
   * 
   * @var KeyValuePair $KeyValuePair
   * @access public
   */
  public $KeyValuePair;

  /**
   * 
   * @param KeyValuePair $KeyValuePair
   * @access public
   */
  public function __construct($KeyValuePair)
  {
    $this->KeyValuePair = $KeyValuePair;
  }

}
