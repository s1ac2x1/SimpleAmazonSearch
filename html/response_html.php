<?php

class ResponseHTML
{
    private $itemReports = array();
    private $html;

    public function addItemReport($itemReport)
    {
        array_push($this->itemReports, $itemReport);
    }

    public function html()
    {
        foreach ($this->itemReports as &$report) {
            echo $report . "<br>";
        }
    }
}

?>
