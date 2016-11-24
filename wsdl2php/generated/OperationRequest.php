<?php

class OperationRequest
{

  /**
   * 
   * @var HTTPHeaders $HTTPHeaders
   * @access public
   */
  public $HTTPHeaders;

  /**
   * 
   * @var string $RequestId
   * @access public
   */
  public $RequestId;

  /**
   * 
   * @var Arguments $Arguments
   * @access public
   */
  public $Arguments;

  /**
   * 
   * @var Errors $Errors
   * @access public
   */
  public $Errors;

  /**
   * 
   * @var float $RequestProcessingTime
   * @access public
   */
  public $RequestProcessingTime;

  /**
   * 
   * @param HTTPHeaders $HTTPHeaders
   * @param string $RequestId
   * @param Arguments $Arguments
   * @param Errors $Errors
   * @param float $RequestProcessingTime
   * @access public
   */
  public function __construct($HTTPHeaders, $RequestId, $Arguments, $Errors, $RequestProcessingTime)
  {
    $this->HTTPHeaders = $HTTPHeaders;
    $this->RequestId = $RequestId;
    $this->Arguments = $Arguments;
    $this->Errors = $Errors;
    $this->RequestProcessingTime = $RequestProcessingTime;
  }

}
