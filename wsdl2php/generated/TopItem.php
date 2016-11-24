<?php

class TopItem
{

  /**
   * 
   * @var string $ASIN
   * @access public
   */
  public $ASIN;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @var string $DetailPageURL
   * @access public
   */
  public $DetailPageURL;

  /**
   * 
   * @var string $ProductGroup
   * @access public
   */
  public $ProductGroup;

  /**
   * 
   * @var string $Author
   * @access public
   */
  public $Author;

  /**
   * 
   * @var string $Artist
   * @access public
   */
  public $Artist;

  /**
   * 
   * @var string $Actor
   * @access public
   */
  public $Actor;

  /**
   * 
   * @param string $ASIN
   * @param string $Title
   * @param string $DetailPageURL
   * @param string $ProductGroup
   * @param string $Author
   * @param string $Artist
   * @param string $Actor
   * @access public
   */
  public function __construct($ASIN, $Title, $DetailPageURL, $ProductGroup, $Author, $Artist, $Actor)
  {
    $this->ASIN = $ASIN;
    $this->Title = $Title;
    $this->DetailPageURL = $DetailPageURL;
    $this->ProductGroup = $ProductGroup;
    $this->Author = $Author;
    $this->Artist = $Artist;
    $this->Actor = $Actor;
  }

}
