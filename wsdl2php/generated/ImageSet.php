<?php

class ImageSet
{

  /**
   * 
   * @var Image $SwatchImage
   * @access public
   */
  public $SwatchImage;

  /**
   * 
   * @var Image $SmallImage
   * @access public
   */
  public $SmallImage;

  /**
   * 
   * @var Image $ThumbnailImage
   * @access public
   */
  public $ThumbnailImage;

  /**
   * 
   * @var Image $TinyImage
   * @access public
   */
  public $TinyImage;

  /**
   * 
   * @var Image $MediumImage
   * @access public
   */
  public $MediumImage;

  /**
   * 
   * @var Image $LargeImage
   * @access public
   */
  public $LargeImage;

  /**
   * 
   * @var string $Category
   * @access public
   */
  public $Category;

  /**
   * 
   * @param Image $SwatchImage
   * @param Image $SmallImage
   * @param Image $ThumbnailImage
   * @param Image $TinyImage
   * @param Image $MediumImage
   * @param Image $LargeImage
   * @param string $Category
   * @access public
   */
  public function __construct($SwatchImage, $SmallImage, $ThumbnailImage, $TinyImage, $MediumImage, $LargeImage, $Category)
  {
    $this->SwatchImage = $SwatchImage;
    $this->SmallImage = $SmallImage;
    $this->ThumbnailImage = $ThumbnailImage;
    $this->TinyImage = $TinyImage;
    $this->MediumImage = $MediumImage;
    $this->LargeImage = $LargeImage;
    $this->Category = $Category;
  }

}
