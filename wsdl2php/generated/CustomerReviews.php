<?php

class CustomerReviews
{

  /**
   * 
   * @var string $IFrameURL
   * @access public
   */
  public $IFrameURL;

  /**
   * 
   * @var boolean $HasReviews
   * @access public
   */
  public $HasReviews;

  /**
   * 
   * @param string $IFrameURL
   * @param boolean $HasReviews
   * @access public
   */
  public function __construct($IFrameURL, $HasReviews)
  {
    $this->IFrameURL = $IFrameURL;
    $this->HasReviews = $HasReviews;
  }

}
