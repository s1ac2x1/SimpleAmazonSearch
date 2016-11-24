<?php

class FavoriteItem
{

    public $id;
    public $asin;
    public $title;
    public $title_decoded;
    public $smallImgURL;
    public $smallImgURL_decoded;
    public $date;
    public $fb_id;
    public $imgH;
    public $imgW;
    public $error;
    public $price;

    public function __construct($id, $asin, $title, $smallImgURL, $date, $fb_id, $imgH, $imgW, $error, $price)
    {
        $this->id = $id;
        $this->asin = $asin;
        $this->title = $title;
        $this->title_decoded = base64_decode($title);
        $this->smallImgURL = $smallImgURL;
        $this->smallImgURL_decoded = base64_decode($smallImgURL);
        $this->date = $date;
        $this->fb_id = $fb_id;
        $this->imgH = $imgH;
        $this->imgW = $imgW;
        $this->error = $error;
        $this->price = $price;
    }

}

?>
