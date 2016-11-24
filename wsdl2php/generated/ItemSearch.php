<?php

class ItemSearch
{

  /**
   * 
   * @var string $MarketplaceDomain
   * @access public
   */
  public $MarketplaceDomain;

  /**
   * 
   * @var string $AWSAccessKeyId
   * @access public
   */
  public $AWSAccessKeyId;

  /**
   * 
   * @var string $AssociateTag
   * @access public
   */
  public $AssociateTag;

  /**
   * 
   * @var string $XMLEscaping
   * @access public
   */
  public $XMLEscaping;

  /**
   * 
   * @var string $Validate
   * @access public
   */
  public $Validate;

  /**
   * 
   * @var ItemSearchRequest $Shared
   * @access public
   */
  public $Shared;

  /**
   * 
   * @var ItemSearchRequest $Request
   * @access public
   */
  public $Request;

  /**
   * 
   * @param string $MarketplaceDomain
   * @param string $AWSAccessKeyId
   * @param string $AssociateTag
   * @param string $XMLEscaping
   * @param string $Validate
   * @param ItemSearchRequest $Shared
   * @param ItemSearchRequest $Request
   * @access public
   */
  public function __construct($MarketplaceDomain, $AWSAccessKeyId, $AssociateTag, $XMLEscaping, $Validate, $Shared, $Request)
  {
    $this->MarketplaceDomain = $MarketplaceDomain;
    $this->AWSAccessKeyId = $AWSAccessKeyId;
    $this->AssociateTag = $AssociateTag;
    $this->XMLEscaping = $XMLEscaping;
    $this->Validate = $Validate;
    $this->Shared = $Shared;
    $this->Request = $Request;
  }

}
