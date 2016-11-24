<?php

class ItemLink
{

  /**
   * 
   * @var string $Description
   * @access public
   */
  public $Description;

  /**
   * 
   * @var string $URL
   * @access public
   */
  public $URL;

  /**
   * 
   * @param string $Description
   * @param string $URL
   * @access public
   */
  public function __construct($Description, $URL)
  {
    $this->Description = $Description;
    $this->URL = $URL;
  }

}
