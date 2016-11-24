<?php

class ItemSearchResponse
{

  /**
   * 
   * @var OperationRequest $OperationRequest
   * @access public
   */
  public $OperationRequest;

  /**
   * 
   * @var Items $Items
   * @access public
   */
  public $Items;

  /**
   * 
   * @param OperationRequest $OperationRequest
   * @param Items $Items
   * @access public
   */
  public function __construct($OperationRequest, $Items)
  {
    $this->OperationRequest = $OperationRequest;
    $this->Items = $Items;
  }

}
