<?php
require_once(dirname(__FILE__) . "/../data/Item.php");
require_once(dirname(__FILE__) . "/../data/Items.php");
require_once(dirname(__FILE__) . "/../data/Error.php");
require_once(dirname(__FILE__) . "/../data/Errors.php");
require_once(dirname(__FILE__) . "/../data/Request.php");
require_once(dirname(__FILE__) . "/../data/OperationRequest.php");
require_once(dirname(__FILE__) . "/../data/ItemSearchResponse.php");
require_once(dirname(__FILE__) . "/../data/ItemLink.php");
require_once(dirname(__FILE__) . "/../data/ItemLinks.php");
require_once(dirname(__FILE__) . "/../data/Image.php");
require_once(dirname(__FILE__) . "/../data/ItemAttributes.php");
require_once(dirname(__FILE__) . "/../data/Creator.php");
require_once(dirname(__FILE__) . "/../data/ItemDimensions.php");
require_once(dirname(__FILE__) . "/../data/Language.php");
require_once(dirname(__FILE__) . "/../data/Languages.php");
require_once(dirname(__FILE__) . "/../data/Price.php");
require_once(dirname(__FILE__) . "/../data/DecimalWithUnits.php");
require_once(dirname(__FILE__) . "/../data/PackageDimensions.php");
require_once(dirname(__FILE__) . "/../data/VariationAttribute.php");
require_once(dirname(__FILE__) . "/../data/VariationAttributes.php");
require_once(dirname(__FILE__) . "/../data/RelatedItem.php");
require_once(dirname(__FILE__) . "/../data/RelatedItems.php");
require_once(dirname(__FILE__) . "/../data/OfferSummary.php");
require_once(dirname(__FILE__) . "/../data/Offer.php");
require_once(dirname(__FILE__) . "/../data/Offers.php");
require_once(dirname(__FILE__) . "/../data/OfferListing.php");
require_once(dirname(__FILE__) . "/../data/OfferAttributes.php");
require_once(dirname(__FILE__) . "/../data/Merchant.php");
require_once(dirname(__FILE__) . "/../data/AvailabilityAttributes.php");
require_once(dirname(__FILE__) . "/../data/LoyaltyPoints.php");
require_once(dirname(__FILE__) . "/../data/Promotion.php");
require_once(dirname(__FILE__) . "/../data/Promotions.php");
require_once(dirname(__FILE__) . "/../data/Summary.php");
require_once(dirname(__FILE__) . "/../data/VariationSummary.php");
require_once(dirname(__FILE__) . "/../data/Variations.php");
require_once(dirname(__FILE__) . "/../data/VariationDimensions.php");
require_once(dirname(__FILE__) . "/../data/CustomerReviews.php");
require_once(dirname(__FILE__) . "/../data/EditorialReview.php");
require_once(dirname(__FILE__) . "/../data/EditorialReviews.php");
require_once(dirname(__FILE__) . "/../data/SimilarProduct.php");
require_once(dirname(__FILE__) . "/../data/SimilarProducts.php");
require_once(dirname(__FILE__) . "/../data/Track.php");
require_once(dirname(__FILE__) . "/../data/Tracks.php");
require_once(dirname(__FILE__) . "/../data/Disc.php");

class Constructor
{

    private $xml;
    private $ItemSearchResponse;

    public function __construct($xml)
    {
        $this->xml = $xml;
    }

    public function getItemSearchResponse()
    {
        $Items = new Items();

        $Items->Qid = $this->xml->Items->Qid;
        $Items->TotalResults = $this->xml->Items->TotalResults;
        $Items->TotalPages = $this->xml->Items->TotalPages;
        $Items->MoreSearchResultsUrl = $this->xml->Items->MoreSearchResultsUrl;

        $Request = new Request();
        $Errors = new Errors();
        if ($this->xml->Items->Request->Errors) {
            $Error = new Error($this->xml->Items->Request->Errors->Error[0]->Code, $this->xml->Items->Request->Errors->Error[0]->Message);
            $Errors->Error = $Error;
        }
        $Request->Errors = $Errors;
        $Items->Request = $Request;

        $itemsCount = 0;
        foreach ($this->xml->Items->Item as $item) {
            $Item = new Item();
            $Item->ASIN = $item->ASIN;
            $Item->ParentASIN = $item->ParentASIN;
            $Item->DetailPageURL = $item->DetailPageURL;

            $ItemLinks = new ItemLinks;
            if ($item->ItemLinks) {
                $itemLinksCount = 0;
                foreach ($item->ItemLinks as $link) {
                    $ItemLink = new ItemLink();
                    $ItemLink->Description = $link->Description;
                    $ItemLink->URL = $link->URL;
                    $ItemLinks->ItemLink[$itemLinksCount] = $ItemLink;
                    $itemLinksCount++;
                }
            }
            $Item->ItemLinks = $ItemLinks;

            $Item->SalesRank = $item->SalesRank;

            $smallImage = new Image();
            $smallImage->URL = $item->SmallImage->URL;
            $Item->SmallImage = $smallImage;

            $mediumImage = new Image();
            $mediumImage->URL = $item->MediumImage->URL;
            $Item->MediumImage = $mediumImage;

            $largeImage = new Image;
            $largeImage->URL = $item->LargeImage->URL;
            $Item->LargeImage = $largeImage;

            $ItemAttributes = new ItemAttributes;
            $ItemAttributes->Actor = $item->ItemAttributes->Actor;
            $ItemAttributes->Artist = $item->ItemAttributes->Artist;
            $ItemAttributes->AspectRatio = $item->ItemAttributes->AspectRatio;
            $ItemAttributes->AudienceRating = $item->ItemAttributes->AudienceRating;
            $ItemAttributes->AudioFormat = $item->ItemAttributes->AudioFormat;
            $ItemAttributes->AudioFormat = $item->ItemAttributes->AudioFormat;
            $ItemAttributes->Binding = $item->ItemAttributes->Binding;
            $ItemAttributes->Brand = $item->ItemAttributes->Brand;
            $ItemAttributes->Category = $item->ItemAttributes->Category;
            $ItemAttributes->CEROAgeRating = $item->ItemAttributes->CEROAgeRating;
            $ItemAttributes->ClothingSize = $item->ItemAttributes->ClothingSize;
            $ItemAttributes->Color = $item->ItemAttributes->Color;
            $ItemAttributes->Department = $item->ItemAttributes->Department;
            $ItemAttributes->Director = $item->ItemAttributes->Director;
            $ItemAttributes->Edition = $item->ItemAttributes->Edition;
            $ItemAttributes->EISBN = $item->ItemAttributes->EISBN;
            $ItemAttributes->EpisodeSequence = $item->ItemAttributes->EpisodeSequence;
            $ItemAttributes->ESRBAgeRating = $item->ItemAttributes->ESRBAgeRating;
            $ItemAttributes->Feature = $item->ItemAttributes->Feature;
            $ItemAttributes->Format = $item->ItemAttributes->Format;
            $ItemAttributes->Genre = $item->ItemAttributes->Genre;
            $ItemAttributes->Genre = $item->ItemAttributes->Genre;
            $ItemAttributes->HardwarePlatform = $item->ItemAttributes->HardwarePlatform;
            $ItemAttributes->HazardousMaterialType = $item->ItemAttributes->HazardousMaterialType;
            $ItemAttributes->IsAdultProduct = $item->ItemAttributes->IsAdultProduct;
            $ItemAttributes->IsAutographed = $item->ItemAttributes->IsAutographed;
            $ItemAttributes->ISBN = $item->ItemAttributes->ISBN;
            $ItemAttributes->IsEligibleForTradeIn = $item->ItemAttributes->IsEligibleForTradeIn;
            $ItemAttributes->IsMemorabilia = $item->ItemAttributes->IsMemorabilia;
            $ItemAttributes->IssuesPerYear = $item->ItemAttributes->IssuesPerYear;
            $ItemAttributes->ItemPartNumber = $item->ItemAttributes->ItemPartNumber;
            $ItemAttributes->Label = $item->ItemAttributes->Label;
            $ItemAttributes->LegalDisclaimer = $item->ItemAttributes->LegalDisclaimer;
            $ItemAttributes->MagazineType = $item->ItemAttributes->MagazineType;
            $ItemAttributes->Manufacturer = $item->ItemAttributes->Manufacturer;
            $ItemAttributes->ManufacturerPartsWarrantyDescription = $item->ItemAttributes->ManufacturerPartsWarrantyDescription;
            $ItemAttributes->MediaType = $item->ItemAttributes->MediaType;
            $ItemAttributes->ModelYear = $item->ItemAttributes->ModelYear;
            $ItemAttributes->MPN = $item->ItemAttributes->MPN;
            $ItemAttributes->NumberOfDiscs = $item->ItemAttributes->NumberOfDiscs;
            $ItemAttributes->NumberOfIssues = $item->ItemAttributes->NumberOfIssues;
            $ItemAttributes->NumberOfItems = $item->ItemAttributes->NumberOfItems;
            $ItemAttributes->NumberOfPages = $item->ItemAttributes->NumberOfPages;
            $ItemAttributes->NumberOfTracks = $item->ItemAttributes->NumberOfTracks;
            $ItemAttributes->PackageQuantity = $item->ItemAttributes->PackageQuantity;
            $ItemAttributes->PartNumber = $item->ItemAttributes->PartNumber;
            $ItemAttributes->PictureFormat = $item->ItemAttributes->PictureFormat;
            $ItemAttributes->Platform = $item->ItemAttributes->Platform;
            $ItemAttributes->ProductGroup = $item->ItemAttributes->ProductGroup;
            $ItemAttributes->ProductTypeName = $item->ItemAttributes->ProductTypeName;
            $ItemAttributes->ProductTypeSubcategory = $item->ItemAttributes->ProductTypeSubcategory;
            $ItemAttributes->PublicationDate = $item->ItemAttributes->PublicationDate;
            $ItemAttributes->Publisher = $item->ItemAttributes->Publisher;
            $ItemAttributes->RegionCode = $item->ItemAttributes->RegionCode;
            $ItemAttributes->ReleaseDate = $item->ItemAttributes->ReleaseDate;
            $ItemAttributes->SeikodoProductCode = $item->ItemAttributes->SeikodoProductCode;
            $ItemAttributes->Size = $item->ItemAttributes->Size;
            $ItemAttributes->SKU = $item->ItemAttributes->SKU;
            $ItemAttributes->Studio = $item->ItemAttributes->Studio;
            $ItemAttributes->Title = $item->ItemAttributes->Title;
            $ItemAttributes->TrackSequence = $item->ItemAttributes->TrackSequence;
            $ItemAttributes->UPC = $item->ItemAttributes->UPC;
            $ItemAttributes->Warranty = $item->ItemAttributes->Warranty;
            $Creator = new Creator();
            $Creator->Role = $item->ItemAttributes->Creator->Role;
            $ItemAttributes->Creator = $Creator;
            $ItemDimensions = new ItemDimensions();
            $ItemDimensions->Height = $item->ItemAttributes->ItemDimensions->Height;
            $ItemDimensions->Length = $item->ItemAttributes->ItemDimensions->Length;
            $ItemDimensions->Weight = $item->ItemAttributes->ItemDimensions->Weight;
            $ItemDimensions->Width = $item->ItemAttributes->ItemDimensions->Width;
            $ItemAttributes->ItemDimensions = $ItemDimensions;
            $Languages = new Languages();
            $languagesCount = 0;
            if ($item->ItemAttributes->Languages) {
                foreach ($item->ItemAttributes->Languages->Language as $lang) {
                    $Language = new Language();
                    $Language->AudioFormat = $lang->AudioFormat;
                    $Language->Name = $lang->Name;
                    $Language->Type = $lang->Type;
                    $Languages->Language[$languagesCount] = $Language;
                    $languagesCount++;
                }
            }
            $ItemAttributes->Languages = $Languages;
            $ListPrice = new Price();
            $ListPrice->Amount = $item->ItemAttributes->ListPrice->Amount;
            $ListPrice->CurrencyCode = $item->ItemAttributes->ListPrice->CurrencyCode;
            $ListPrice->FormattedPrice = $item->ItemAttributes->ListPrice->FormattedPrice;
            $Item->ItemAttributes->ListPrice = $ListPrice;
            $ManufacturerMaximumAge = new DecimalWithUnits();
            $ManufacturerMaximumAge->Units = $item->ItemAttributes->ManufacturerMaximumAge->Units;
            $Item->ItemAttributes->ManufacturerMaximumAge = $ManufacturerMaximumAge;
            $ManufacturerMinimumAge = new DecimalWithUnits();
            $ManufacturerMinimumAge->Units = $item->ItemAttributes->ManufacturerMinimumAge->Units;
            $Item->ItemAttributes->ManufacturerMinimumAge = $ManufacturerMinimumAge;
            $PackageDimensions = new PackageDimensions();
            $PackageDimensions->Height = $item->ItemAttributes->PackageDimensions->Height;
            $PackageDimensions->Length = $item->ItemAttributes->PackageDimensions->Length;
            $PackageDimensions->Weight = $item->ItemAttributes->PackageDimensions->Weight;
            $PackageDimensions->Width = $item->ItemAttributes->PackageDimensions->Width;
            $Item->ItemAttributes->PackageDimensions = $PackageDimensions;
            $TradeInValue = new Price();
            $TradeInValue->Amount = $item->ItemAttributes->TradeInValue->Amount;
            $TradeInValue->CurrencyCode = $item->ItemAttributes->TradeInValue->CurrencyCode;
            $TradeInValue->FormattedPrice = $item->ItemAttributes->TradeInValue->FormattedPrice;
            $Item->ItemAttributes->TradeInValue = $TradeInValue;
            $WEEETaxValue = new Price();
            $WEEETaxValue->Amount = $item->ItemAttributes->WEEETaxValue->Amount;
            $WEEETaxValue->CurrencyCode = $item->ItemAttributes->WEEETaxValue->CurrencyCode;
            $WEEETaxValue->FormattedPrice = $item->ItemAttributes->WEEETaxValue->FormattedPrice;
            $Item->ItemAttributes->WEEETaxValue = $WEEETaxValue;
            $Item->ItemAttributes = $ItemAttributes;

            $VariationAttributes = new VariationAttributes();
            $variationAttributeCount = 0;
            if ($item->VariationAttributes) {
                foreach ($item->VariationAttributes->VariationAttribute as $attr) {
                    $VariationAttribute = new VariationAttribute();
                    $VariationAttribute->Name = $attr->Name;
                    $VariationAttribute->Value = $att->Value;
                    $VariationAttributes->VariationAttribute[$variationAttributeCount] = $VariationAttribute;
                    $variationAttributeCount++;
                }
            }
            $Item->VariationAttributes = $VariationAttributes;

            $RelatedItems = new RelatedItems();
            $RelatedItems->RelatedItemCount = $item->RelatedItems->RelatedItemCount;
            $RelatedItems->RelatedItemPageCount = $item->RelatedItems->RelatedItemPageCount;
            $RelatedItems->RelatedItemPage = $item->RelatedItems->RelatedItemPage;
            $relatedItemsCount = 0;
            if ($item->RelatedItems) {
                foreach ($item->RelatedItems->RelatedItem as $relatedItem) {
                    $RelatedItem = new RelatedItem();
                    $item_ = new Item();
                    $item_ = $RelatedItem->Item->ASIN;
                    $RelatedItem->Item = $item_;
                    $RelatedItems->RelatedItem[$relatedItemsCount] = $RelatedItem;
                    $relatedItemsCount++;
                }
            }
            $Item->RelatedItems = $RelatedItems;

            $OfferSummary = new OfferSummary();
            $OfferSummary_LowestNewPrice = new Price();
            $OfferSummary_LowestNewPrice->Amount = $item->OfferSummary->LowestNewPrice->Amount;
            $OfferSummary_LowestNewPrice->CurrencyCode = $item->OfferSummary->LowestNewPrice->CurrencyCode;
            $OfferSummary_LowestNewPrice->FormattedPrice = $item->OfferSummary->LowestNewPrice->FormattedPrice;
            $OfferSummary->LowestNewPrice = $OfferSummary_LowestNewPrice;
            $OfferSummary_LowestUsedPrice = new Price();
            $OfferSummary_LowestUsedPrice->Amount = $item->OfferSummary->LowestUsedPrice->Amount;
            $OfferSummary_LowestUsedPrice->CurrencyCode = $item->OfferSummary->LowestUsedPrice->CurrencyCode;
            $OfferSummary_LowestUsedPrice->FormattedPrice = $item->OfferSummary->LowestUsedPrice->FormattedPrice;
            $OfferSummary->LowestUsedPrice = $OfferSummary_LowestUsedPrice;
            $OfferSummary_LowestCollectiblePrice = new Price();
            $OfferSummary_LowestCollectiblePrice->Amount = $item->OfferSummary->LowestCollectiblePrice->Amount;
            $OfferSummary_LowestCollectiblePrice->CurrencyCode = $item->OfferSummary->LowestCollectiblePrice->CurrencyCode;
            $OfferSummary_LowestCollectiblePrice->FormattedPrice = $item->OfferSummary->LowestCollectiblePrice->FormattedPrice;
            $OfferSummary->LowestCollectiblePrice = $OfferSummary_LowestCollectiblePrice;
            $OfferSummary_LowestRefurbishedPrice = new Price();
            $OfferSummary_LowestRefurbishedPrice->Amount = $item->OfferSummary->LowestRefurbishedPrice->Amount;
            $OfferSummary_LowestRefurbishedPrice->CurrencyCode = $item->OfferSummary->LowestRefurbishedPrice->CurrencyCode;
            $OfferSummary_LowestRefurbishedPrice->FormattedPrice = $item->OfferSummary->LowestRefurbishedPrice->FormattedPrice;
            $OfferSummary->LowestRefurbishedPrice = $OfferSummary_LowestRefurbishedPrice;
            $OfferSummary->TotalNew = $item->OfferSummary->TotalNew;
            $OfferSummary->TotalUsed = $item->OfferSummary->TotalUsed;
            $OfferSummary->TotalCollectible = $item->OfferSummary->TotalCollectible;
            $OfferSummary->TotalRefurbished = $item->OfferSummary->TotalRefurbished;
            $Item->OfferSummary = $OfferSummary;

            $Offers = new Offers();
            $Offers->TotalOffers = $item->Offers->TotalOffers;
            $Offers->TotalOfferPages = $item->Offers->TotalOfferPages;
            $Offers->MoreOffersUrl = $item->Offers->MoreOffersUrl;
            $itemOffersCount = 0;
            foreach ($item->Offers->Offer as $offer) {
                $Offers_Offer = new Offer();
                $Offers_Offer_Merchant = new Merchant();
                $Offers_Offer_Merchant->Name = $offer->Merchant->Name;
                $Offers_Offer->Merchant = $Offers_Offer_Merchant;
                $Offers_Offer_Attributes = new OfferAttributes();
                $Offers_Offer_Attributes->Condition = $offer->OfferAttributes->Condition;
                $Offers_Offer->OfferAttributes = $Offers_Offer_Attributes;
//OfferListing
                $Offers_Offer_OfferListing = new OfferListing();
                $Offers_Offer_OfferListing->OfferListingId = $offer->OfferListing->OfferListingId;
                //OfferListing Price
                $Offers_Offer_OfferListing_Price = new Price();
                $Offers_Offer_OfferListing_Price->Amount = $offer->OfferListing->Price->Amount;
                $Offers_Offer_OfferListing_Price->CurrencyCode = $offer->OfferListing->Price->CurrencyCode;
                $Offers_Offer_OfferListing_Price->FormattedPrice = $offer->OfferListing->Price->FormattedPrice;
                $Offers_Offer_OfferListing->Price = $Offers_Offer_OfferListing_Price;
                // Offer Listing Price end

                // Offer Listing Sale Price
                $Offers_Offer_OfferListing_SalePrice = new Price();
                $Offers_Offer_OfferListing_SalePrice->Amount = $offer->OfferListing->SalePrice->Amount;
                $Offers_Offer_OfferListing_SalePrice->CurrencyCode = $offer->OfferListing->SalePrice->CurrencyCode;
                $Offers_Offer_OfferListing_SalePrice->FormattedPrice = $offer->OfferListing->SalePrice->FormattedPrice;
                $Offers_Offer_OfferListing->SalePrice = $Offers_Offer_OfferListing_SalePrice;
                // Offer Listing Sale Price end

                // Offer Listing Amount Saved
                $Offers_Offer_OfferListing_AmountSaved = new Price();
                $Offers_Offer_OfferListing_AmountSaved->Amount = $offer->OfferListing->AmountSaved->Amount;
                $Offers_Offer_OfferListing_AmountSaved->CurrencyCode = $offer->OfferListing->AmountSaved->CurrencyCode;
                $Offers_Offer_OfferListing_AmountSaved->FormattedPrice = $offer->OfferListing->AmountSaved->FormattedPrice;
                $Offers_Offer_OfferListing->AmountSaved = $Offers_Offer_OfferListing_AmountSaved;
                // Offer Listing Amount Saved end

                $Offers_Offer_OfferListing->PercentageSaved = $offer->OfferListing->PercentageSaved;
                $Offers_Offer_OfferListing->Availability = $offer->OfferListing->Availability;

                // Offer Listing Availability attributes
                $Offers_Offer_OfferListing_AvailabilityAtrributes = new AvailabilityAttributes();
                $Offers_Offer_OfferListing_AvailabilityAtrributes->AvailabilityType = $offer->OfferListing->AvailabilityAttributes->AvailabilityType;
                $Offers_Offer_OfferListing_AvailabilityAtrributes->IsPreorder = $offer->OfferListing->AvailabilityAttributes->IsPreorder;
                $Offers_Offer_OfferListing_AvailabilityAtrributes->MaximumHours = $offer->OfferListing->AvailabilityAttributes->MaximumHours;
                $Offers_Offer_OfferListing_AvailabilityAtrributes->MinimumHours = $offer->OfferListing->AvailabilityAttributes->MinimumPrice;
                $Offers_Offer_OfferListing->AvailabilityAttributes = $Offers_Offer_OfferListing_AvailabilityAtrributes;
                // Offer Listing Availability attributes end

                $Offers_Offer_OfferListing->IsEligibleForSuperSaverShipping = $offer->OfferListing->IsEligibleForSuperSaverShipping;
                $Offers_Offer_OfferListing->IsEligibleForPrime = $offer->OfferListing->IsEligibleForPrime;

//OfferListing end
                $Offers_Offer->OfferListing = $Offers_Offer_OfferListing;

// Offer LoyaltyPoints
                $Offers_Offer_LoyaltyPoints = new LoyaltyPoints();
                $Offers_Offer_LoyaltyPoints->Points = $offer->LoyaltyPoints->Points;
                $Offers_Offer_LoyaltyPoints_TypicalRedemptionValue = new Price();
                $Offers_Offer_LoyaltyPoints_TypicalRedemptionValue->Amount = $offer->LoyaltyPoints->TypicalRedemptionValue->Amount;
                $Offers_Offer_LoyaltyPoints_TypicalRedemptionValue->CurrencyCode = $offer->LoyaltyPoints->TypicalRedemptionValue->CurrencyCode;
                $Offers_Offer_LoyaltyPoints_TypicalRedemptionValue->FormattedPrice = $offer->LoyaltyPoints->TypicalRedemptionValue->FormattedPrice;
                $Offers_Offer_LoyaltyPoints->TypicalRedemptionValue = $Offers_Offer_LoyaltyPoints_TypicalRedemptionValue;
                $Offers_Offer->LoyaltyPoints = $Offers_Offer_LoyaltyPoints;
// Offer LoyaltyPoints end

                $Offers_Offer_Promotions = new Promotions();
                if ($offer->Promotions) {
                    $promotionsCount = 0;
                    foreach ($offer->Promotions->Promotion as $promotion_) {
                        $Promotion = new Promotion();
                        $Promotion_Summary = new Summary();
                        $Promotion_Summary->BenefitDescription = $promotion_->Summary->BenefitDescription;
                        $Promotion_Summary->Category = $promotion_->Summary->Category;
                        $Promotion_Summary->EligibilityRequirementDescription = $promotion_->Summary->EligibilityRequirementDescription;
                        $Promotion_Summary->EndDate = $promotion_->Summary->EndDate;
                        $Promotion_Summary->PromotionId = $promotion_->Summary->PromotionId;
                        $Promotion_Summary->StartDate = $promotion_->Summary->StartDate;
                        $Promotion_Summary->TermsAndConditions = $promotion_->TermsAndConditions;
                        $Promotion->Summary = $Promotion_Summary;
                        $Offers_Offer_Promotions->Promotion[$promotionsCount] = $Promotion;
                        $promotionsCount++;
                    }
                }
                $Offers_Offer->Promotions = $Offers_Offer_Promotions;

                $Offers->Offer[$itemOffersCount] = $Offers_Offer;
                $itemOffersCount++;
            }
            $Item->Offers = $Offers;

            $VariationSummary = new VariationSummary;
            $VariationSummary_LowestPrice = new Price();
            $VariationSummary_LowestPrice->Amount = $item->VariationSummary->LowestPrice->Amount;
            $VariationSummary_LowestPrice->CurrencyCode = $item->VariationSummary->LowestPrice->CurrencyCode;
            $VariationSummary_LowestPrice->FormattedPrice = $item->VariationSummary->LowestPrice->FormattedPrice;
            $VariationSummary->LowestPrice = $VariationSummary_LowestPrice;
            $VariationSummary_HighestPrice = new Price();
            $VariationSummary_HighestPrice->Amount = $item->VariationSummary->HighestPrice->Amount;
            $VariationSummary_HighestPrice->CurrencyCode = $item->VariationSummary->HighestPrice->CurrencyCode;
            $VariationSummary_HighestPrice->FormattedPrice = $item->VariationSummary->HighestPrice->FormattedPrice;
            $VariationSummary->HighestPrice = $VariationSummary_HighestPrice;
            $VariationSummary_LowestSalePrice = new Price();
            $VariationSummary_LowestSalePrice->Amount = $item->VariationSummary->LowestSalePrice->Amount;
            $VariationSummary_LowestSalePrice->CurrencyCode = $item->VariationSummary->LowestSalePrice->CurrencyCode;
            $VariationSummary_LowestSalePrice->FormattedPrice = $item->VariationSummary->LowestSalePrice->FormattedPrice;
            $VariationSummary->LowestSalePrice = $VariationSummary_LowestSalePrice;
            $VariationSummary_HighestSalePrice = new Price();
            $VariationSummary_HighestSalePrice->Amount = $item->VariationSummary->HighestSalePrice->Amount;
            $VariationSummary_HighestSalePrice->CurrencyCode = $item->VariationSummary->HighestSalePrice->CurrencyCode;
            $VariationSummary_HighestSalePrice->FormattedPrice = $item->VariationSummary->HighestSalePrice->FormattedPrice;
            $VariationSummary->HighestSalePrice = $VariationSummary_HighestSalePrice;
            $Item->VariationSummary = $VariationSummary;

            $Variations = new Variations();
            $Variations->TotalVariations = $item->Variations->TotalVariations;
            $Variations->TotalVariationPages = $item->Variations->TotalVariationPages;
            $Variations_VariationDimensions = new VariationDimensions();
            $Variations_VariationDimensions->VariationDimension = $item->Variations->VariationDimensions->VariationDimension;
            $Variations->VariationDimensions = $Variations_VariationDimensions;
            if ($item->Variations) {
                $varItemCount = 0;
                foreach ($item->Variations->Item as $varItem_) {
                    $Variations_Item = new Item();
                    $Variations_Item->ASIN = $varItem_->ASIN;
                    $Variations->Item[$varItemCount] = $Variations_Item;
                    $varItemCount++;
                }
            }
            $Item->Variations = $Variations;

            $CustomerReviews = new CustomerReviews();
            $CustomerReviews->HasReviews = $item->CustomerReviews->HasReviews;
            $CustomerReviews->IFrameURL = $item->IFrameURL;
            $Item->CustomerReviews = $CustomerReviews;

            $EditorialReviews = new EditorialReviews();
            if ($item->EditorialReviews) {
                $eReview = 0;
                foreach ($item->EditorialReviews->EditorialReview as $review) {
                    $EditorialReview = new EditorialReview();
                    $EditorialReview->Content = $review->Content;
                    $EditorialReview->IsLinkSuppressed = $review->IsLinkSuppressed;
                    $EditorialReview->Source = $review->Source;
                    $EditorialReviews->EditorialReview[$eReview] = $EditorialReview;
                    $eReview++;
                }
            }
            $Item->EditorialReviews = $EditorialReviews;

            $SimilarProducts = new SimilarProducts;
            if ($item->SimilarProducts) {
                $simProductsCount = 0;
                foreach ($item->SimilarProducts->SimilarProduct as $product) {
                    $SimilarProduct = new SimilarProduct();
                    $SimilarProduct->ASIN = $product->ASIN;
                    $SimilarProduct->Title = $product->Title;
                    $SimilarProducts->SimilarProduct[$simProductsCount] = $SimilarProduct;
                    $simProductsCount++;
                }
            }
            $Item->SimilarProducts = $SimilarProducts;

            $Tracks = new Tracks();
            $Tracks_Disc = new Disc();
            $Tracks_Disc_Track = new Track();
            $Tracks_Disc_Track->Number = $item->Tracks->Disc->Track->Number;
            $Tracks_Disc->Track = $Tracks_Disc_Track;
            $Tracks_Disc->Number = $item->Tracks->Disc->Number;
            $Tracks->Disc = $Tracks_Disc;
            $Item->Tracks = $Tracks;

            //end populate item

            $Items->Item[$itemsCount] = $Item;
            $itemsCount++;
        }
        $this->ItemSearchResponse = new ItemSearchResponse();
        $this->ItemSearchResponse->Items = $Items;

        $OperationRequest = new OperationRequest();
        $OperationRequest->RequestProcessingTime = $this->xml->OperationRequest->RequestProcessingTime;

        $this->ItemSearchResponse->OperationRequest = $OperationRequest;
        return $this->ItemSearchResponse;
    }

}

?>
