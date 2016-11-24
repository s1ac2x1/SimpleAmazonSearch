<?php

class AlternateVersion
{

  /**
   * 
   * @var string $ASIN
   * @access public
   */
  public $ASIN;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @var string $Binding
   * @access public
   */
  public $Binding;

  /**
   * 
   * @param string $ASIN
   * @param string $Title
   * @param string $Binding
   * @access public
   */
  public function __construct($ASIN, $Title, $Binding)
  {
    $this->ASIN = $ASIN;
    $this->Title = $Title;
    $this->Binding = $Binding;
  }

}
