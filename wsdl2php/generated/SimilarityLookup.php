<?php

class SimilarityLookup
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
   * @var string $Validate
   * @access public
   */
  public $Validate;

  /**
   * 
   * @var string $XMLEscaping
   * @access public
   */
  public $XMLEscaping;

  /**
   * 
   * @var SimilarityLookupRequest $Shared
   * @access public
   */
  public $Shared;

  /**
   * 
   * @var SimilarityLookupRequest $Request
   * @access public
   */
  public $Request;

  /**
   * 
   * @param string $MarketplaceDomain
   * @param string $AWSAccessKeyId
   * @param string $AssociateTag
   * @param string $Validate
   * @param string $XMLEscaping
   * @param SimilarityLookupRequest $Shared
   * @param SimilarityLookupRequest $Request
   * @access public
   */
  public function __construct($MarketplaceDomain, $AWSAccessKeyId, $AssociateTag, $Validate, $XMLEscaping, $Shared, $Request)
  {
    $this->MarketplaceDomain = $MarketplaceDomain;
    $this->AWSAccessKeyId = $AWSAccessKeyId;
    $this->AssociateTag = $AssociateTag;
    $this->Validate = $Validate;
    $this->XMLEscaping = $XMLEscaping;
    $this->Shared = $Shared;
    $this->Request = $Request;
  }

}
