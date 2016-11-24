<?php

class Request
{

  /**
   * 
   * @var string $IsValid
   * @access public
   */
  public $IsValid;

  /**
   * 
   * @var BrowseNodeLookupRequest $BrowseNodeLookupRequest
   * @access public
   */
  public $BrowseNodeLookupRequest;

  /**
   * 
   * @var ItemSearchRequest $ItemSearchRequest
   * @access public
   */
  public $ItemSearchRequest;

  /**
   * 
   * @var ItemLookupRequest $ItemLookupRequest
   * @access public
   */
  public $ItemLookupRequest;

  /**
   * 
   * @var SimilarityLookupRequest $SimilarityLookupRequest
   * @access public
   */
  public $SimilarityLookupRequest;

  /**
   * 
   * @var CartGetRequest $CartGetRequest
   * @access public
   */
  public $CartGetRequest;

  /**
   * 
   * @var CartAddRequest $CartAddRequest
   * @access public
   */
  public $CartAddRequest;

  /**
   * 
   * @var CartCreateRequest $CartCreateRequest
   * @access public
   */
  public $CartCreateRequest;

  /**
   * 
   * @var CartModifyRequest $CartModifyRequest
   * @access public
   */
  public $CartModifyRequest;

  /**
   * 
   * @var CartClearRequest $CartClearRequest
   * @access public
   */
  public $CartClearRequest;

  /**
   * 
   * @var Errors $Errors
   * @access public
   */
  public $Errors;

  /**
   * 
   * @param string $IsValid
   * @param BrowseNodeLookupRequest $BrowseNodeLookupRequest
   * @param ItemSearchRequest $ItemSearchRequest
   * @param ItemLookupRequest $ItemLookupRequest
   * @param SimilarityLookupRequest $SimilarityLookupRequest
   * @param CartGetRequest $CartGetRequest
   * @param CartAddRequest $CartAddRequest
   * @param CartCreateRequest $CartCreateRequest
   * @param CartModifyRequest $CartModifyRequest
   * @param CartClearRequest $CartClearRequest
   * @param Errors $Errors
   * @access public
   */
  public function __construct($IsValid, $BrowseNodeLookupRequest, $ItemSearchRequest, $ItemLookupRequest, $SimilarityLookupRequest, $CartGetRequest, $CartAddRequest, $CartCreateRequest, $CartModifyRequest, $CartClearRequest, $Errors)
  {
    $this->IsValid = $IsValid;
    $this->BrowseNodeLookupRequest = $BrowseNodeLookupRequest;
    $this->ItemSearchRequest = $ItemSearchRequest;
    $this->ItemLookupRequest = $ItemLookupRequest;
    $this->SimilarityLookupRequest = $SimilarityLookupRequest;
    $this->CartGetRequest = $CartGetRequest;
    $this->CartAddRequest = $CartAddRequest;
    $this->CartCreateRequest = $CartCreateRequest;
    $this->CartModifyRequest = $CartModifyRequest;
    $this->CartClearRequest = $CartClearRequest;
    $this->Errors = $Errors;
  }

}
