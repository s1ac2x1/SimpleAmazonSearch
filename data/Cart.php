<?php

class Cart
{

  /**
   * 
   * @var Request $Request
   * @access public
   */
  public $Request;

  /**
   * 
   * @var string $CartId
   * @access public
   */
  public $CartId;

  /**
   * 
   * @var string $HMAC
   * @access public
   */
  public $HMAC;

  /**
   * 
   * @var string $URLEncodedHMAC
   * @access public
   */
  public $URLEncodedHMAC;

  /**
   * 
   * @var string $PurchaseURL
   * @access public
   */
  public $PurchaseURL;

  /**
   * 
   * @var string $MobileCartURL
   * @access public
   */
  public $MobileCartURL;

  /**
   * 
   * @var Price $SubTotal
   * @access public
   */
  public $SubTotal;

  /**
   * 
   * @var CartItems $CartItems
   * @access public
   */
  public $CartItems;

  /**
   * 
   * @var SavedForLaterItems $SavedForLaterItems
   * @access public
   */
  public $SavedForLaterItems;

  /**
   * 
   * @var SimilarProducts $SimilarProducts
   * @access public
   */
  public $SimilarProducts;

  /**
   * 
   * @var TopSellers $TopSellers
   * @access public
   */
  public $TopSellers;

  /**
   * 
   * @var NewReleases $NewReleases
   * @access public
   */
  public $NewReleases;

  /**
   * 
   * @var SimilarViewedProducts $SimilarViewedProducts
   * @access public
   */
  public $SimilarViewedProducts;

  /**
   * 
   * @var OtherCategoriesSimilarProducts $OtherCategoriesSimilarProducts
   * @access public
   */
  public $OtherCategoriesSimilarProducts;

}
