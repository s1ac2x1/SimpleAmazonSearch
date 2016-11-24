<?php

class ItemSearchLargeHTML
{

    private $ItemSearchResponse;
    private $html_;

    public function __construct($ItemSearchResponse)
    {
        $this->ItemSearchResponse = $ItemSearchResponse;
        $this->convert();
    }

    public function __destruct()
    {
        unset($this->ItemSearchResponse);
        unset($this->html_);
    }

    public function html()
    {
        return $this->html_;
    }

    private function convert()
    {
        //$this->html_ = $this->item->ASIN;
    }

}

?>
