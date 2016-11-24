<?php

class SimilarProducts
{

  /**
   * 
   * @var SimilarProduct $SimilarProduct
   * @access public
   */
  public $SimilarProduct;

  /**
   * 
   * @param SimilarProduct $SimilarProduct
   * @access public
   */
  public function __construct($SimilarProduct)
  {
    $this->SimilarProduct = $SimilarProduct;
  }

}
