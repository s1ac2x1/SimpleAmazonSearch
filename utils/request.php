<?php
	require_once(dirname(__FILE__) . "/core/WSRequest.php");
	$wsRequest = new WSRequest();
	$configuration = array();
	$conf = $_POST['conf'];
	$conf1 = explode(",", $conf);
	foreach ( $conf1 as $value ) {
		$conf2 = explode("=", $value);
		$configuration[trim($conf2[0])] = trim($conf2[1]);
	}
	$wsRequest->configure($configuration);
	echo $wsRequest->getSignedUrl(false);
?>
