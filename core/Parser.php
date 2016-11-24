<?php
require_once(dirname(__FILE__) . "/../semantics/AbstractFind.php");
require_once(dirname(__FILE__) . "/../wrappers/BaseSearchWrapper.php");
require_once(dirname(__FILE__) . "/../data/Item.php");
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

class Parser
{
    private $inputString;
    private $inputStringAsArray = array();
    private $inputStringWithoutKeywordArray = array();
    private $html_;

    private function c($str)
    {
        $this->inputString = $str;
        $this->inputStringAsArray = array_filter(explode(" ", $this->inputString));
        $keyword = $this->getKeyword();
        $request = preg_replace("/\b$keyword\b/", "", $str);
        $request = str_replace('"', "", $request);
        $request = str_replace("''", "", $request);
        $this->inputStringWithoutKeywordArray = array_filter(explode(" ", $request));
        $this->analyze();
    }

    public function __destruct()
    {
        unset($this->inputStringAsArray);
    }

    function getKeyword()
    {
        $str = $this->inputString;
        preg_match('/"(.*?)"/', $str, $matches);
        return isset($matches[1]) ? $matches[1] : FALSE;
    }

    private function analyze()
    {
        $keyword = $this->getKeyword();
        $str = $this->inputString;
        $request = preg_replace("/\b$keyword\b/", "", $str);
        $request = str_replace('"', "", $request);
        $request = str_replace("''", "", $request);
        $this->researchFindRequest($request, $keyword);
    }

    private function researchFindRequest($request, $keyword)
    {
        $findWordsLibContent = file_get_contents(dirname(__FILE__) . "/../semantics/lib/find.lib");
        $findWordsArray = explode(";", $findWordsLibContent);
        $isFindWordsPresent = 0;
        foreach ($findWordsArray as $word) {
            if (in_array($word, $this->inputStringWithoutKeywordArray)) {
                $isFindWordsPresent = 1;
            }
        }
        if ($isFindWordsPresent == 1) {
            $find = new AbstractFind($request, $keyword);
            $this->html_ = $find->html();
        }
    }

    public function getBaseSearchWrapper($keyword, $index, $accessKeyID, $secretAccessKey, $trackingID)
    {
        $search = new Search($accessKeyID, $trackingID, $secretAccessKey);
        $baseSearchWrapper = new BaseSearchWrapper();
        $conf = parse_ini_file(dirname(__FILE__) . "/../conf.ini");
        if (strpos($keyword, $conf['debugString']) > 0) {
            $keyword = str_replace($conf['debugString'], "", $keyword);
            $baseSearchWrapper->debug = "on";
        }
        $xml = $search->getItemSearchResponseXML($keyword, $index);
        if ($xml == "limit") {
            $baseSearchWrapper->errorMessage = "limit";
        } else if ($xml->Items->Request->Errors->Error->Message) {
            $baseSearchWrapper->errorMessage = $xml->Items->Request->Errors->Error->Message;
        } else {
            foreach ($xml->Items->Item as $item) {
                array_push($baseSearchWrapper->items, $item);
            }
            $baseSearchWrapper->totalResults = $xml->Items->TotalResults;
        }
        return $baseSearchWrapper;
    }

    public function html()
    {
        return $this->html_;
    }

}

?>
