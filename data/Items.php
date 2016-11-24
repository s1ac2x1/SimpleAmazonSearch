<?php

class Items
{

  /**
   * 
   * @var Request $Request
   * @access public
   */
  public $Request;

  /**
   * 
   * @var CorrectedQuery $CorrectedQuery
   * @access public
   */
  public $CorrectedQuery;

  /**
   * 
   * @var string $Qid
   * @access public
   */
  public $Qid;

  /**
   * 
   * @var string $EngineQuery
   * @access public
   */
  public $EngineQuery;

  /**
   * 
   * @var int $TotalResults
   * @access public
   */
  public $TotalResults;

  /**
   * 
   * @var int $TotalPages
   * @access public
   */
  public $TotalPages;

  /**
   * 
   * @var string $MoreSearchResultsUrl
   * @access public
   */
  public $MoreSearchResultsUrl;

  /**
   * 
   * @var SearchResultsMap $SearchResultsMap
   * @access public
   */
  public $SearchResultsMap;

  /**
   * 
   * @var Item $Item
   * @access public
   */
  public $Item = array();

  /**
   * 
   * @var SearchBinSets $SearchBinSets
   * @access public
   */
  public $SearchBinSets;

}
