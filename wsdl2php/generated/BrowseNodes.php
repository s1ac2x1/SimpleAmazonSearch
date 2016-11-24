<?php

class BrowseNodes
{

  /**
   * 
   * @var Request $Request
   * @access public
   */
  public $Request;

  /**
   * 
   * @var BrowseNode $BrowseNode
   * @access public
   */
  public $BrowseNode;

  /**
   * 
   * @param Request $Request
   * @param BrowseNode $BrowseNode
   * @access public
   */
  public function __construct($Request, $BrowseNode)
  {
    $this->Request = $Request;
    $this->BrowseNode = $BrowseNode;
  }

}
