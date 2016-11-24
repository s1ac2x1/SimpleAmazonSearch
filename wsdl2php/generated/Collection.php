<?php

class Collection
{

  /**
   * 
   * @var CollectionSummary $CollectionSummary
   * @access public
   */
  public $CollectionSummary;

  /**
   * 
   * @var CollectionParent $CollectionParent
   * @access public
   */
  public $CollectionParent;

  /**
   * 
   * @var CollectionItem $CollectionItem
   * @access public
   */
  public $CollectionItem;

  /**
   * 
   * @param CollectionSummary $CollectionSummary
   * @param CollectionParent $CollectionParent
   * @param CollectionItem $CollectionItem
   * @access public
   */
  public function __construct($CollectionSummary, $CollectionParent, $CollectionItem)
  {
    $this->CollectionSummary = $CollectionSummary;
    $this->CollectionParent = $CollectionParent;
    $this->CollectionItem = $CollectionItem;
  }

}
