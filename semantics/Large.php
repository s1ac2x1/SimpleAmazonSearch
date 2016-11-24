<?php
require(dirname(__FILE__) . "/../core/Constructor.php");
require(dirname(__FILE__) . "/../html/ItemSearchLargeHTML.php");

class Large
{

    private $keyword;
    private $html_;

    public function __construct($keyword)
    {
        $this->keyword = $keyword;
        $this->process();
    }

    public function html()
    {
        return $this->html_;
    }

    private function process()
    {
        $wsRequest = new WSRequest();
        $configuration = array(
            'Operation' => 'ItemSearch',
            'SearchIndex' => 'All',
            'Keywords' => $this->keyword,
            'ResponseGroup' => 'Medium',
            'Availability' => 'Available',
            'Condition' => 'All'
        );
        $wsRequest->configure($configuration);
        $xml = $wsRequest->xml();
        $constructor = new Constructor($xml);
        $ItemSearchResponse = $constructor->getItemSearchResponse();
        $HTML = new ItemSearchLargeHTML($ItemSearchResponse);
        $this->html_ = $HTML->html();
    }

}

?>
