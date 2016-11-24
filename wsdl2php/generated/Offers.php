<?php

class Offers
{

  /**
   * 
   * @var int $TotalOffers
   * @access public
   */
  public $TotalOffers;

  /**
   * 
   * @var int $TotalOfferPages
   * @access public
   */
  public $TotalOfferPages;

  /**
   * 
   * @var string $MoreOffersUrl
   * @access public
   */
  public $MoreOffersUrl;

  /**
   * 
   * @var Offer $Offer
   * @access public
   */
  public $Offer;

  /**
   * 
   * @param int $TotalOffers
   * @param int $TotalOfferPages
   * @param string $MoreOffersUrl
   * @param Offer $Offer
   * @access public
   */
  public function __construct($TotalOffers, $TotalOfferPages, $MoreOffersUrl, $Offer)
  {
    $this->TotalOffers = $TotalOffers;
    $this->TotalOfferPages = $TotalOfferPages;
    $this->MoreOffersUrl = $MoreOffersUrl;
    $this->Offer = $Offer;
  }

}
