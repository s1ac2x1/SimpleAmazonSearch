<?php

class Summary
{

  /**
   * 
   * @var string $PromotionId
   * @access public
   */
  public $PromotionId;

  /**
   * 
   * @var string $Category
   * @access public
   */
  public $Category;

  /**
   * 
   * @var string $StartDate
   * @access public
   */
  public $StartDate;

  /**
   * 
   * @var string $EndDate
   * @access public
   */
  public $EndDate;

  /**
   * 
   * @var string $EligibilityRequirementDescription
   * @access public
   */
  public $EligibilityRequirementDescription;

  /**
   * 
   * @var string $BenefitDescription
   * @access public
   */
  public $BenefitDescription;

  /**
   * 
   * @var string $TermsAndConditions
   * @access public
   */
  public $TermsAndConditions;

  /**
   * 
   * @param string $PromotionId
   * @param string $Category
   * @param string $StartDate
   * @param string $EndDate
   * @param string $EligibilityRequirementDescription
   * @param string $BenefitDescription
   * @param string $TermsAndConditions
   * @access public
   */
  public function __construct($PromotionId, $Category, $StartDate, $EndDate, $EligibilityRequirementDescription, $BenefitDescription, $TermsAndConditions)
  {
    $this->PromotionId = $PromotionId;
    $this->Category = $Category;
    $this->StartDate = $StartDate;
    $this->EndDate = $EndDate;
    $this->EligibilityRequirementDescription = $EligibilityRequirementDescription;
    $this->BenefitDescription = $BenefitDescription;
    $this->TermsAndConditions = $TermsAndConditions;
  }

}
