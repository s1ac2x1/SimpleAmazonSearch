<?php

class CorrectedQuery
{

  /**
   * 
   * @var string $Keywords
   * @access public
   */
  public $Keywords;

  /**
   * 
   * @var string $Message
   * @access public
   */
  public $Message;

  /**
   * 
   * @param string $Keywords
   * @param string $Message
   * @access public
   */
  public function __construct($Keywords, $Message)
  {
    $this->Keywords = $Keywords;
    $this->Message = $Message;
  }

}
