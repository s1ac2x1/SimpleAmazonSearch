<?php

class EditorialReview
{

  /**
   * 
   * @var string $Source
   * @access public
   */
  public $Source;

  /**
   * 
   * @var string $Content
   * @access public
   */
  public $Content;

  /**
   * 
   * @var boolean $IsLinkSuppressed
   * @access public
   */
  public $IsLinkSuppressed;

  /**
   * 
   * @param string $Source
   * @param string $Content
   * @param boolean $IsLinkSuppressed
   * @access public
   */
  public function __construct($Source, $Content, $IsLinkSuppressed)
  {
    $this->Source = $Source;
    $this->Content = $Content;
    $this->IsLinkSuppressed = $IsLinkSuppressed;
  }

}
