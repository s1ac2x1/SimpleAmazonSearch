<?php

class LibUtils
{

    public static function searchInRequest($requestArray, $libFileName)
    {
        $wordsLibContent = file_get_contents(dirname(__FILE__) . "/../semantics/lib/$libFileName");
        $wordsArray = explode(";", $wordsLibContent);
        $isWordsPresent = 0;
        foreach ($wordsArray as $word) {
            if (in_array($word, $requestArray)) {
                $isWordsPresent = 1;
            }
        }
        return $isWordsPresent;
    }
}

?>
