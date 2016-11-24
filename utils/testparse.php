<?php
	require_once(dirname(__FILE__) . "/core/Parser.php");
	require_once(dirname(__FILE__) . "/html/BaseSearchHTML.php");
	
	$keyword = "canon 60d";
	$parser = new Parser();
	$baseSearchWrapper = $parser->getBaseSearchWrapper($keyword);
	$baseSearchWrapper->keyword = $keyword;
	$baseSearchHTML = new BaseSearchHTML($baseSearchWrapper);
	
	if ($baseSearchHTML->good()) {
		echo $baseSearchHTML->printCircles();
	} else {
		echo $baseSearchHTML->printErrorMessage();
	}
?>
