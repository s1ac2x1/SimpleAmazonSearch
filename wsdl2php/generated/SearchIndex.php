<?php

class SearchIndex
{

  /**
   * 
   * @var string $IndexName
   * @access public
   */
  public $IndexName;

  /**
   * 
   * @var int $Results
   * @access public
   */
  public $Results;

  /**
   * 
   * @var int $Pages
   * @access public
   */
  public $Pages;

  /**
   * 
   * @var CorrectedQuery $CorrectedQuery
   * @access public
   */
  public $CorrectedQuery;

  /**
   * 
   * @var int $RelevanceRank
   * @access public
   */
  public $RelevanceRank;

  /**
   * 
   * @var string $ASIN
   * @access public
   */
  public $ASIN;

  /**
   * 
   * @param string $IndexName
   * @param int $Results
   * @param int $Pages
   * @param CorrectedQuery $CorrectedQuery
   * @param int $RelevanceRank
   * @param string $ASIN
   * @access public
   */
  public function __construct($IndexName, $Results, $Pages, $CorrectedQuery, $RelevanceRank, $ASIN)
  {
    $this->IndexName = $IndexName;
    $this->Results = $Results;
    $this->Pages = $Pages;
    $this->CorrectedQuery = $CorrectedQuery;
    $this->RelevanceRank = $RelevanceRank;
    $this->ASIN = $ASIN;
  }

}
