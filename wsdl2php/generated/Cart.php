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

  /**
   * 
   * @param Request $Request
   * @param string $CartId
   * @param string $HMAC
   * @param string $URLEncodedHMAC
   * @param string $PurchaseURL
   * @param string $MobileCartURL
   * @param Price $SubTotal
   * @param CartItems $CartItems
   * @param SavedForLaterItems $SavedForLaterItems
   * @param SimilarProducts $SimilarProducts
   * @param TopSellers $TopSellers
   * @param NewReleases $NewReleases
   * @param SimilarViewedProducts $SimilarViewedProducts
   * @param OtherCategoriesSimilarProducts $OtherCategoriesSimilarProducts
   * @access public
   */
  public function __construct($Request, $CartId, $HMAC, $URLEncodedHMAC, $PurchaseURL, $MobileCartURL, $SubTotal, $CartItems, $SavedForLaterItems, $SimilarProducts, $TopSellers, $NewReleases, $SimilarViewedProducts, $OtherCategoriesSimilarProducts)
  {
    $this->Request = $Request;
    $this->CartId = $CartId;
    $this->HMAC = $HMAC;
    $this->URLEncodedHMAC = $URLEncodedHMAC;
    $this->PurchaseURL = $PurchaseURL;
    $this->MobileCartURL = $MobileCartURL;
    $this->SubTotal = $SubTotal;
    $this->CartItems = $CartItems;
    $this->SavedForLaterItems = $SavedForLaterItems;
    $this->SimilarProducts = $SimilarProducts;
    $this->TopSellers = $TopSellers;
    $this->NewReleases = $NewReleases;
    $this->SimilarViewedProducts = $SimilarViewedProducts;
    $this->OtherCategoriesSimilarProducts = $OtherCategoriesSimilarProducts;
  }

}
