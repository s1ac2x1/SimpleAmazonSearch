<?php

class RelatedItems
{

  /**
   * 
   * @var Relationship $Relationship
   * @access public
   */
  public $Relationship;

  /**
   * 
   * @var string $RelationshipType
   * @access public
   */
  public $RelationshipType;

  /**
   * 
   * @var int $RelatedItemCount
   * @access public
   */
  public $RelatedItemCount;

  /**
   * 
   * @var int $RelatedItemPageCount
   * @access public
   */
  public $RelatedItemPageCount;

  /**
   * 
   * @var int $RelatedItemPage
   * @access public
   */
  public $RelatedItemPage;

  /**
   * 
   * @var RelatedItem $RelatedItem
   * @access public
   */
  public $RelatedItem;

  /**
   * 
   * @param Relationship $Relationship
   * @param string $RelationshipType
   * @param int $RelatedItemCount
   * @param int $RelatedItemPageCount
   * @param int $RelatedItemPage
   * @param RelatedItem $RelatedItem
   * @access public
   */
  public function __construct($Relationship, $RelationshipType, $RelatedItemCount, $RelatedItemPageCount, $RelatedItemPage, $RelatedItem)
  {
    $this->Relationship = $Relationship;
    $this->RelationshipType = $RelationshipType;
    $this->RelatedItemCount = $RelatedItemCount;
    $this->RelatedItemPageCount = $RelatedItemPageCount;
    $this->RelatedItemPage = $RelatedItemPage;
    $this->RelatedItem = $RelatedItem;
  }

}
