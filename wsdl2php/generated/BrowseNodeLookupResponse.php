<?php

class BrowseNodeLookupResponse
{

  /**
   * 
   * @var OperationRequest $OperationRequest
   * @access public
   */
  public $OperationRequest;

  /**
   * 
   * @var BrowseNodes $BrowseNodes
   * @access public
   */
  public $BrowseNodes;

  /**
   * 
   * @param OperationRequest $OperationRequest
   * @param BrowseNodes $BrowseNodes
   * @access public
   */
  public function __construct($OperationRequest, $BrowseNodes)
  {
    $this->OperationRequest = $OperationRequest;
    $this->BrowseNodes = $BrowseNodes;
  }

}
