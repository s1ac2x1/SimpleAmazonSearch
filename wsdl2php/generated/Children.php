<?php

class Children
{

  /**
   * 
   * @var BrowseNode $BrowseNode
   * @access public
   */
  public $BrowseNode;

  /**
   * 
   * @param BrowseNode $BrowseNode
   * @access public
   */
  public function __construct($BrowseNode)
  {
    $this->BrowseNode = $BrowseNode;
  }

}
