<?php

class Creator
{

  /**
   * 
   * @var string $_
   * @access public
   */
  public $_;

  /**
   * 
   * @var string $Role
   * @access public
   */
  public $Role;

  /**
   * 
   * @param string $_
   * @param string $Role
   * @access public
   */
  public function __construct($_, $Role)
  {
    $this->_ = $_;
    $this->Role = $Role;
  }

}
