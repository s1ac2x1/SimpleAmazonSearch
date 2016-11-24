<?php
require_once(dirname(__FILE__) . "/../semantics/LibUtils.php");
require_once(dirname(__FILE__) . "/../core/Search.php");
require_once(dirname(__FILE__) . "/../wrappers/ImageASIN.php");

class AbstractFind
{
    private $request;
    private $requestArray;
    private $keyword;
    private $html_;

    public function __construct($request, $keyword)
    {
        $this->request = $request;
        $this->keyword = $keyword;
        $this->requestArray = explode(" ", $request);
        $this->factory();
    }

    private function factory()
    {
        if (LibUtils::searchInRequest($this->requestArray, "best.lib")) {
            $search = new Search();
            $search->findTheCheapest($this->keyword);
        }
    }

    public function html()
    {
        return $this->html_;
    }

}

?>