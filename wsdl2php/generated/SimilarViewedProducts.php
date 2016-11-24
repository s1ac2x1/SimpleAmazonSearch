<?php

class SimilarViewedProducts
{

  /**
   * 
   * @var SimilarViewedProduct $SimilarViewedProduct
   * @access public
   */
  public $SimilarViewedProduct;

  /**
   * 
   * @param SimilarViewedProduct $SimilarViewedProduct
   * @access public
   */
  public function __construct($SimilarViewedProduct)
  {
    $this->SimilarViewedProduct = $SimilarViewedProduct;
  }

}
