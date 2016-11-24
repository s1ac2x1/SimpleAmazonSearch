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

}
