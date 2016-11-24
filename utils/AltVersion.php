<?php

class AltVersion
{

    public function __construct($asin, $title, $binding)
    {
        $this->asin = $asin;
        $this->title = $title;
        $this->binding = $binding;
    }

    public $asin;
    public $title;
    public $binding;

}

?>
