<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Oops..</title>
    <style type="text/css">
        body {
            background: url("http://simpleamazonsearch.com/img/bg.png") repeat scroll 0 0 rgb(223, 223, 223);
        }

    </style>
</head>
<body>
<?php

$url = base64_decode($externalImg);
?>
<div id="external-shared-image">
    <center>
        <a href="http://simpleamazonsearch.com"><font face="Lucida Console" style="font-size: 24pt">Simple Amazon
                Search</font></a>
        <h2>We don't have such URL, sorry.</h2>
        <h4>You can visit the <a href="http://simpleamazonsearch.com">main page</a> and try to find something
            interesting</h4>
        <h1>But wait!</h1>
        <?
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $urlParts = explode("/", $url);
        $end = $urlParts[count($urlParts) - 1];
        $end = preg_replace("/\\.[^.\\s]{2,4}$/", "", $end);
        $end = urldecode($end);
        ?>
        <h3>You have searched for <font style="color:red"><? echo $end; ?></font>?<br><br>
            <a href="http://simpleamazonsearch.com/s:<? echo $end; ?>">Let's find it</a> using our cute search filters!
        </h3>
    </center>
</div>
</body>
</html>
