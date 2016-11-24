<?php

class OfferListing
{

  /**
   * 
   * @var string $OfferListingId
   * @access public
   */
  public $OfferListingId;

  /**
   * 
   * @var Price $Price
   * @access public
   */
  public $Price;

  /**
   * 
   * @var Price $SalePrice
   * @access public
   */
  public $SalePrice;

  /**
   * 
   * @var Price $AmountSaved
   * @access public
   */
  public $AmountSaved;

  /**
   * 
   * @var int $PercentageSaved
   * @access public
   */
  public $PercentageSaved;

  /**
   * 
   * @var string $Availability
   * @access public
   */
  public $Availability;

  /**
   * 
   * @var AvailabilityAttributes $AvailabilityAttributes
   * @access public
   */
  public $AvailabilityAttributes;

  /**
   * 
   * @var boolean $IsEligibleForSuperSaverShipping
   * @access public
   */
  public $IsEligibleForSuperSaverShipping;

  /**
   * 
   * @var boolean $IsEligibleForPrime
   * @access public
   */
  public $IsEligibleForPrime;

  /**
   * 
   * @param string $OfferListingId
   * @param Price $Price
   * @param Price $SalePrice
   * @param Price $AmountSaved
   * @param int $PercentageSaved
   * @param string $Availability
   * @param AvailabilityAttributes $AvailabilityAttributes
   * @param boolean $IsEligibleForSuperSaverShipping
   * @param boolean $IsEligibleForPrime
   * @access public
   */
  public function __construct($OfferListingId, $Price, $SalePrice, $AmountSaved, $PercentageSaved, $Availability, $AvailabilityAttributes, $IsEligibleForSuperSaverShipping, $IsEligibleForPrime)
  {
    $this->OfferListingId = $OfferListingId;
    $this->Price = $Price;
    $this->SalePrice = $SalePrice;
    $this->AmountSaved = $AmountSaved;
    $this->PercentageSaved = $PercentageSaved;
    $this->Availability = $Availability;
    $this->AvailabilityAttributes = $AvailabilityAttributes;
    $this->IsEligibleForSuperSaverShipping = $IsEligibleForSuperSaverShipping;
    $this->IsEligibleForPrime = $IsEligibleForPrime;
  }

}
