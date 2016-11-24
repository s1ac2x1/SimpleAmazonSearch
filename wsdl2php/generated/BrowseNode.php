<?php

class BrowseNode
{

  /**
   * 
   * @var string $BrowseNodeId
   * @access public
   */
  public $BrowseNodeId;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var boolean $IsCategoryRoot
   * @access public
   */
  public $IsCategoryRoot;

  /**
   * 
   * @var Properties $Properties
   * @access public
   */
  public $Properties;

  /**
   * 
   * @var Children $Children
   * @access public
   */
  public $Children;

  /**
   * 
   * @var Ancestors $Ancestors
   * @access public
   */
  public $Ancestors;

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
   * @var TopItemSet $TopItemSet
   * @access public
   */
  public $TopItemSet;

  /**
   * 
   * @param string $BrowseNodeId
   * @param string $Name
   * @param boolean $IsCategoryRoot
   * @param Properties $Properties
   * @param Children $Children
   * @param Ancestors $Ancestors
   * @param TopSellers $TopSellers
   * @param NewReleases $NewReleases
   * @param TopItemSet $TopItemSet
   * @access public
   */
  public function __construct($BrowseNodeId, $Name, $IsCategoryRoot, $Properties, $Children, $Ancestors, $TopSellers, $NewReleases, $TopItemSet)
  {
    $this->BrowseNodeId = $BrowseNodeId;
    $this->Name = $Name;
    $this->IsCategoryRoot = $IsCategoryRoot;
    $this->Properties = $Properties;
    $this->Children = $Children;
    $this->Ancestors = $Ancestors;
    $this->TopSellers = $TopSellers;
    $this->NewReleases = $NewReleases;
    $this->TopItemSet = $TopItemSet;
  }

}
