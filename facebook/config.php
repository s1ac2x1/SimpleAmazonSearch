<?php
/* -----------------------------------------------------------------------------------------
   IdiotMinds - http://idiotminds.com
   -----------------------------------------------------------------------------------------
*/
session_start();
//Facebook App Id and Secret
$appID='293090604143643';
$appSecret='63fa56a6e6f23f5a59ddf68c9fae209e';

//URL to your website root
if($_SERVER['HTTP_HOST']=='localhost'){
$base_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}else{
$base_url='http://'.$_SERVER['HTTP_HOST']."/index.php";
}
?>