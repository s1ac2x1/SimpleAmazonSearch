<?php

class SearchBinSet
{

  /**
   * 
   * @var Bin $Bin
   * @access public
   */
  public $Bin;

  /**
   * 
   * @var string $NarrowBy
   * @access public
   */
  public $NarrowBy;

  /**
   * 
   * @param Bin $Bin
   * @param string $NarrowBy
   * @access public
   */
  public function __construct($Bin, $NarrowBy)
  {
    $this->Bin = $Bin;
    $this->NarrowBy = $NarrowBy;
  }

}
