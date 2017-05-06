<?php

include_once('Bin.php');
include_once('BinParameter.php');
include_once('SearchBinSet.php');
include_once('SearchBinSets.php');
include_once('ItemSearch.php');
include_once('ItemSearchRequest.php');
include_once('ItemLookup.php');
include_once('ItemLookupRequest.php');
include_once('SimilarityLookup.php');
include_once('SimilarityLookupRequest.php');
include_once('CartGet.php');
include_once('CartGetRequest.php');
include_once('CartAdd.php');
include_once('CartAddRequest.php');
include_once('Items.php');
include_once('Item.php');
include_once('CartCreate.php');
include_once('CartCreateRequest.php');
include_once('MetaData.php');
include_once('CartModify.php');
include_once('CartModifyRequest.php');
include_once('CartClear.php');
include_once('CartClearRequest.php');
include_once('BrowseNodeLookup.php');
include_once('BrowseNodeLookupRequest.php');
include_once('Condition.php');
include_once('AudienceRating.php');
include_once('ItemSearchResponse.php');
include_once('ItemLookupResponse.php');
include_once('SimilarityLookupResponse.php');
include_once('CartGetResponse.php');
include_once('CartAddResponse.php');
include_once('CartCreateResponse.php');
include_once('CartModifyResponse.php');
include_once('CartClearResponse.php');
include_once('BrowseNodeLookupResponse.php');
include_once('OperationRequest.php');
include_once('Request.php');
include_once('Arguments.php');
include_once('Argument.php');
include_once('HTTPHeaders.php');
include_once('Header.php');
include_once('Errors.php');
include_once('Error.php');
include_once('CorrectedQuery.php');
include_once('Cart.php');
include_once('SearchResultsMap.php');
include_once('SearchIndex.php');
include_once('ImageSets.php');
include_once('VariationAttributes.php');
include_once('Subjects.php');
include_once('AlternateVersions.php');
include_once('AlternateVersion.php');
include_once('ItemLinks.php');
include_once('ItemLink.php');
include_once('RelatedItems.php');
include_once('RelatedItem.php');
include_once('OfferSummary.php');
include_once('Offers.php');
include_once('Offer.php');
include_once('OfferAttributes.php');
include_once('Merchant.php');
include_once('OfferListing.php');
include_once('AvailabilityAttributes.php');
include_once('LoyaltyPoints.php');
include_once('VariationAttribute.php');
include_once('VariationSummary.php');
include_once('Variations.php');
include_once('VariationDimensions.php');
include_once('EditorialReviews.php');
include_once('Collections.php');
include_once('Collection.php');
include_once('CollectionSummary.php');
include_once('CollectionParent.php');
include_once('CollectionItem.php');
include_once('EditorialReview.php');
include_once('CustomerReviews.php');
include_once('Tracks.php');
include_once('Disc.php');
include_once('Track.php');
include_once('SimilarProducts.php');
include_once('SimilarProduct.php');
include_once('TopSellers.php');
include_once('TopSeller.php');
include_once('NewReleases.php');
include_once('NewRelease.php');
include_once('TopItemSet.php');
include_once('TopItem.php');
include_once('SimilarViewedProducts.php');
include_once('SimilarViewedProduct.php');
include_once('OtherCategoriesSimilarProducts.php');
include_once('OtherCategoriesSimilarProduct.php');
include_once('Accessories.php');
include_once('Accessory.php');
include_once('Promotions.php');
include_once('Promotion.php');
include_once('Summary.php');
include_once('BrowseNodes.php');
include_once('Property.php');
include_once('BrowseNode.php');
include_once('Properties.php');
include_once('Children.php');
include_once('Ancestors.php');
include_once('CartItems.php');
include_once('SavedForLaterItems.php');
include_once('CartItem.php');
include_once('KeyValuePair.php');
include_once('Price.php');
include_once('ImageSet.php');
include_once('Image.php');
include_once('ItemAttributes.php');
include_once('CatalogNumberList.php');
include_once('Creator.php');
include_once('EANList.php');
include_once('ItemDimensions.php');
include_once('Languages.php');
include_once('Language.php');
include_once('PackageDimensions.php');
include_once('UPCList.php');
include_once('NonNegativeIntegerWithUnits.php');
include_once('DecimalWithUnits.php');
include_once('StringWithUnits.php');
include_once('positiveIntegerOrAll.php');


/**
 * 
 */
class AWSECommerceService extends SoapClient
{

  /**
   * 
   * @var array $classmap The defined classes
   * @access private
   */
  private static $classmap = array(
    'Bin' => 'Bin',
    'BinParameter' => 'BinParameter',
    'SearchBinSet' => 'SearchBinSet',
    'SearchBinSets' => 'SearchBinSets',
    'ItemSearch' => 'ItemSearch',
    'ItemSearchRequest' => 'ItemSearchRequest',
    'ItemLookup' => 'ItemLookup',
    'ItemLookupRequest' => 'ItemLookupRequest',
    'SimilarityLookup' => 'SimilarityLookup',
    'SimilarityLookupRequest' => 'SimilarityLookupRequest',
    'CartGet' => 'CartGet',
    'CartGetRequest' => 'CartGetRequest',
    'CartAdd' => 'CartAdd',
    'CartAddRequest' => 'CartAddRequest',
    'Items' => 'Items',
    'Item' => 'Item',
    'CartCreate' => 'CartCreate',
    'CartCreateRequest' => 'CartCreateRequest',
    'Items' => 'Items',
    'Item' => 'Item',
    'MetaData' => 'MetaData',
    'CartModify' => 'CartModify',
    'CartModifyRequest' => 'CartModifyRequest',
    'Items' => 'Items',
    'Item' => 'Item',
    'CartClear' => 'CartClear',
    'CartClearRequest' => 'CartClearRequest',
    'BrowseNodeLookup' => 'BrowseNodeLookup',
    'BrowseNodeLookupRequest' => 'BrowseNodeLookupRequest',
    'ItemSearchResponse' => 'ItemSearchResponse',
    'ItemLookupResponse' => 'ItemLookupResponse',
    'SimilarityLookupResponse' => 'SimilarityLookupResponse',
    'CartGetResponse' => 'CartGetResponse',
    'CartAddResponse' => 'CartAddResponse',
    'CartCreateResponse' => 'CartCreateResponse',
    'CartModifyResponse' => 'CartModifyResponse',
    'CartClearResponse' => 'CartClearResponse',
    'BrowseNodeLookupResponse' => 'BrowseNodeLookupResponse',
    'OperationRequest' => 'OperationRequest',
    'Request' => 'Request',
    'Arguments' => 'Arguments',
    'Argument' => 'Argument',
    'HTTPHeaders' => 'HTTPHeaders',
    'Header' => 'Header',
    'Errors' => 'Errors',
    'Error' => 'Error',
    'Items' => 'Items',
    'CorrectedQuery' => 'CorrectedQuery',
    'Cart' => 'Cart',
    'SearchResultsMap' => 'SearchResultsMap',
    'SearchIndex' => 'SearchIndex',
    'Item' => 'Item',
    'ImageSets' => 'ImageSets',
    'VariationAttributes' => 'VariationAttributes',
    'Subjects' => 'Subjects',
    'AlternateVersions' => 'AlternateVersions',
    'AlternateVersion' => 'AlternateVersion',
    'ItemLinks' => 'ItemLinks',
    'ItemLink' => 'ItemLink',
    'RelatedItems' => 'RelatedItems',
    'RelatedItem' => 'RelatedItem',
    'OfferSummary' => 'OfferSummary',
    'Offers' => 'Offers',
    'Offer' => 'Offer',
    'OfferAttributes' => 'OfferAttributes',
    'Merchant' => 'Merchant',
    'OfferListing' => 'OfferListing',
    'AvailabilityAttributes' => 'AvailabilityAttributes',
    'LoyaltyPoints' => 'LoyaltyPoints',
    'VariationAttribute' => 'VariationAttribute',
    'VariationSummary' => 'VariationSummary',
    'Variations' => 'Variations',
    'VariationDimensions' => 'VariationDimensions',
    'EditorialReviews' => 'EditorialReviews',
    'Collections' => 'Collections',
    'Collection' => 'Collection',
    'CollectionSummary' => 'CollectionSummary',
    'CollectionParent' => 'CollectionParent',
    'CollectionItem' => 'CollectionItem',
    'EditorialReview' => 'EditorialReview',
    'CustomerReviews' => 'CustomerReviews',
    'Tracks' => 'Tracks',
    'Disc' => 'Disc',
    'Track' => 'Track',
    'SimilarProducts' => 'SimilarProducts',
    'SimilarProduct' => 'SimilarProduct',
    'TopSellers' => 'TopSellers',
    'TopSeller' => 'TopSeller',
    'NewReleases' => 'NewReleases',
    'NewRelease' => 'NewRelease',
    'TopItemSet' => 'TopItemSet',
    'TopItem' => 'TopItem',
    'SimilarViewedProducts' => 'SimilarViewedProducts',
    'SimilarViewedProduct' => 'SimilarViewedProduct',
    'OtherCategoriesSimilarProducts' => 'OtherCategoriesSimilarProducts',
    'OtherCategoriesSimilarProduct' => 'OtherCategoriesSimilarProduct',
    'Accessories' => 'Accessories',
    'Accessory' => 'Accessory',
    'Promotions' => 'Promotions',
    'Promotion' => 'Promotion',
    'Summary' => 'Summary',
    'BrowseNodes' => 'BrowseNodes',
    'Property' => 'Property',
    'BrowseNode' => 'BrowseNode',
    'Properties' => 'Properties',
    'Children' => 'Children',
    'Ancestors' => 'Ancestors',
    'CartItems' => 'CartItems',
    'SavedForLaterItems' => 'SavedForLaterItems',
    'CartItem' => 'CartItem',
    'MetaData' => 'MetaData',
    'KeyValuePair' => 'KeyValuePair',
    'Price' => 'Price',
    'ImageSet' => 'ImageSet',
    'Image' => 'Image',
    'ItemAttributes' => 'ItemAttributes',
    'CatalogNumberList' => 'CatalogNumberList',
    'Creator' => 'Creator',
    'EANList' => 'EANList',
    'ItemDimensions' => 'ItemDimensions',
    'Languages' => 'Languages',
    'Language' => 'Language',
    'PackageDimensions' => 'PackageDimensions',
    'UPCList' => 'UPCList',
    'NonNegativeIntegerWithUnits' => 'NonNegativeIntegerWithUnits',
    'DecimalWithUnits' => 'DecimalWithUnits',
    'StringWithUnits' => 'StringWithUnits');

    /**
     *
     * @param array $options
     * @param string $wsdl The wsdl file to use
     * @internal param array $config A array of config values
     * @access public
     */
  public function __construct(array $options = array(), $wsdl = '')
  {
    foreach(self::$classmap as $key => $value)
    {
      if(!isset($options['classmap'][$key]))
      {
        $options['classmap'][$key] = $value;
      }
    }
    
    parent::__construct($wsdl, $options);
  }

    /**
     *
     * @param ItemSearch $body
     * @access public
     * @return mixed
     */
  public function ItemSearch(ItemSearch $body)
  {
    return $this->__soapCall('ItemSearch', array($body));
  }

    /**
     *
     * @param ItemLookup $body
     * @access public
     * @return mixed
     */
  public function ItemLookup(ItemLookup $body)
  {
    return $this->__soapCall('ItemLookup', array($body));
  }

    /**
     *
     * @param BrowseNodeLookup $body
     * @access public
     * @return mixed
     */
  public function BrowseNodeLookup(BrowseNodeLookup $body)
  {
    return $this->__soapCall('BrowseNodeLookup', array($body));
  }

    /**
     *
     * @param SimilarityLookup $body
     * @access public
     * @return mixed
     */
  public function SimilarityLookup(SimilarityLookup $body)
  {
    return $this->__soapCall('SimilarityLookup', array($body));
  }

    /**
     *
     * @param CartGet $body
     * @access public
     * @return mixed
     */
  public function CartGet(CartGet $body)
  {
    return $this->__soapCall('CartGet', array($body));
  }

    /**
     *
     * @param CartCreate $body
     * @access public
     * @return mixed
     */
  public function CartCreate(CartCreate $body)
  {
    return $this->__soapCall('CartCreate', array($body));
  }

    /**
     *
     * @param CartAdd $body
     * @access public
     * @return mixed
     */
  public function CartAdd(CartAdd $body)
  {
    return $this->__soapCall('CartAdd', array($body));
  }

    /**
     *
     * @param CartModify $body
     * @access public
     * @return mixed
     */
  public function CartModify(CartModify $body)
  {
    return $this->__soapCall('CartModify', array($body));
  }

    /**
     *
     * @param CartClear $body
     * @access public
     * @return mixed
     */
  public function CartClear(CartClear $body)
  {
    return $this->__soapCall('CartClear', array($body));
  }

}
