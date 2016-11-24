<?php 
/* -----------------------------------------------------------------------------------------
   IdiotMinds - http://idiotminds.com
   -----------------------------------------------------------------------------------------
*/
require 'config.php';
if(isset($_SESSION['User']) && !empty($_SESSION['User'])){
session_destroy();
header('Location: '.$base_url);	
	
}

?>