<?php

class VariationAttributes
{

  /**
   * 
   * @var VariationAttribute $VariationAttribute
   * @access public
   */
  public $VariationAttribute;

  /**
   * 
   * @param VariationAttribute $VariationAttribute
   * @access public
   */
  public function __construct($VariationAttribute)
  {
    $this->VariationAttribute = $VariationAttribute;
  }

}
