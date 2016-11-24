<?php

class BrowseNodeLookupRequest
{

  /**
   * 
   * @var string $BrowseNodeId
   * @access public
   */
  public $BrowseNodeId;

  /**
   * 
   * @var string $ResponseGroup
   * @access public
   */
  public $ResponseGroup;

  /**
   * 
   * @param string $BrowseNodeId
   * @param string $ResponseGroup
   * @access public
   */
  public function __construct($BrowseNodeId, $ResponseGroup)
  {
    $this->BrowseNodeId = $BrowseNodeId;
    $this->ResponseGroup = $ResponseGroup;
  }

}
