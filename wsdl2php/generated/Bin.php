<?php

class Bin
{

  /**
   * 
   * @var string $BinName
   * @access public
   */
  public $BinName;

  /**
   * 
   * @var int $BinItemCount
   * @access public
   */
  public $BinItemCount;

  /**
   * 
   * @var BinParameter $BinParameter
   * @access public
   */
  public $BinParameter;

  /**
   * 
   * @param string $BinName
   * @param int $BinItemCount
   * @param BinParameter $BinParameter
   * @access public
   */
  public function __construct($BinName, $BinItemCount, $BinParameter)
  {
    $this->BinName = $BinName;
    $this->BinItemCount = $BinItemCount;
    $this->BinParameter = $BinParameter;
  }

}
