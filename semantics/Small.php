<?php

class Small
{

    private $keyword;
    private $html_;

    public function __construct($keyword)
    {
        $this->keyword = $keyword;
    }

    public function html()
    {
        return $this->html_;
    }

}

?>
