<?php

class Offer
{

  /**
   * 
   * @var Merchant $Merchant
   * @access public
   */
  public $Merchant;

  /**
   * 
   * @var OfferAttributes $OfferAttributes
   * @access public
   */
  public $OfferAttributes;

  /**
   * 
   * @var OfferListing $OfferListing
   * @access public
   */
  public $OfferListing;

  /**
   * 
   * @var LoyaltyPoints $LoyaltyPoints
   * @access public
   */
  public $LoyaltyPoints;

  /**
   * 
   * @var Promotions $Promotions
   * @access public
   */
  public $Promotions;

  /**
   * 
   * @param Merchant $Merchant
   * @param OfferAttributes $OfferAttributes
   * @param OfferListing $OfferListing
   * @param LoyaltyPoints $LoyaltyPoints
   * @param Promotions $Promotions
   * @access public
   */
  public function __construct($Merchant, $OfferAttributes, $OfferListing, $LoyaltyPoints, $Promotions)
  {
    $this->Merchant = $Merchant;
    $this->OfferAttributes = $OfferAttributes;
    $this->OfferListing = $OfferListing;
    $this->LoyaltyPoints = $LoyaltyPoints;
    $this->Promotions = $Promotions;
  }

}
