<?php

class SearchResultsMap
{

  /**
   * 
   * @var SearchIndex $SearchIndex
   * @access public
   */
  public $SearchIndex;

  /**
   * 
   * @param SearchIndex $SearchIndex
   * @access public
   */
  public function __construct($SearchIndex)
  {
    $this->SearchIndex = $SearchIndex;
  }

}
