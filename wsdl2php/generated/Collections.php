<?php

class Collections
{

  /**
   * 
   * @var Collection $Collection
   * @access public
   */
  public $Collection;

  /**
   * 
   * @param Collection $Collection
   * @access public
   */
  public function __construct($Collection)
  {
    $this->Collection = $Collection;
  }

}
