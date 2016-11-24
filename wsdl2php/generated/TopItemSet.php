<?php

class TopItemSet
{

  /**
   * 
   * @var string $Type
   * @access public
   */
  public $Type;

  /**
   * 
   * @var TopItem $TopItem
   * @access public
   */
  public $TopItem;

  /**
   * 
   * @param string $Type
   * @param TopItem $TopItem
   * @access public
   */
  public function __construct($Type, $TopItem)
  {
    $this->Type = $Type;
    $this->TopItem = $TopItem;
  }

}
