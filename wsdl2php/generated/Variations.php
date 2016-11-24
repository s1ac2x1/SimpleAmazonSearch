<?php

class Variations
{

  /**
   * 
   * @var int $TotalVariations
   * @access public
   */
  public $TotalVariations;

  /**
   * 
   * @var int $TotalVariationPages
   * @access public
   */
  public $TotalVariationPages;

  /**
   * 
   * @var VariationDimensions $VariationDimensions
   * @access public
   */
  public $VariationDimensions;

  /**
   * 
   * @var Item $Item
   * @access public
   */
  public $Item;

  /**
   * 
   * @param int $TotalVariations
   * @param int $TotalVariationPages
   * @param VariationDimensions $VariationDimensions
   * @param Item $Item
   * @access public
   */
  public function __construct($TotalVariations, $TotalVariationPages, $VariationDimensions, $Item)
  {
    $this->TotalVariations = $TotalVariations;
    $this->TotalVariationPages = $TotalVariationPages;
    $this->VariationDimensions = $VariationDimensions;
    $this->Item = $Item;
  }

}
