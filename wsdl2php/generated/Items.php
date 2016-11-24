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
  public $Item;

  /**
   * 
   * @var SearchBinSets $SearchBinSets
   * @access public
   */
  public $SearchBinSets;

  /**
   * 
   * @param Request $Request
   * @param CorrectedQuery $CorrectedQuery
   * @param string $Qid
   * @param string $EngineQuery
   * @param int $TotalResults
   * @param int $TotalPages
   * @param string $MoreSearchResultsUrl
   * @param SearchResultsMap $SearchResultsMap
   * @param Item $Item
   * @param SearchBinSets $SearchBinSets
   * @access public
   */
  public function __construct($Request, $CorrectedQuery, $Qid, $EngineQuery, $TotalResults, $TotalPages, $MoreSearchResultsUrl, $SearchResultsMap, $Item, $SearchBinSets)
  {
    $this->Request = $Request;
    $this->CorrectedQuery = $CorrectedQuery;
    $this->Qid = $Qid;
    $this->EngineQuery = $EngineQuery;
    $this->TotalResults = $TotalResults;
    $this->TotalPages = $TotalPages;
    $this->MoreSearchResultsUrl = $MoreSearchResultsUrl;
    $this->SearchResultsMap = $SearchResultsMap;
    $this->Item = $Item;
    $this->SearchBinSets = $SearchBinSets;
  }

}
