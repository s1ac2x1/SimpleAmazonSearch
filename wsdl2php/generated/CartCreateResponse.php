<?php

class CartCreateResponse
{

  /**
   * 
   * @var OperationRequest $OperationRequest
   * @access public
   */
  public $OperationRequest;

  /**
   * 
   * @var Cart $Cart
   * @access public
   */
  public $Cart;

  /**
   * 
   * @param OperationRequest $OperationRequest
   * @param Cart $Cart
   * @access public
   */
  public function __construct($OperationRequest, $Cart)
  {
    $this->OperationRequest = $OperationRequest;
    $this->Cart = $Cart;
  }

}
