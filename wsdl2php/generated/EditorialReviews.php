<?php

class EditorialReviews
{

  /**
   * 
   * @var EditorialReview $EditorialReview
   * @access public
   */
  public $EditorialReview;

  /**
   * 
   * @param EditorialReview $EditorialReview
   * @access public
   */
  public function __construct($EditorialReview)
  {
    $this->EditorialReview = $EditorialReview;
  }

}
