<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="../js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <?
    $imgShortedLink = $_GET['img'];
    if ($imgShortedLink) {
        include("db.php");
        $linksId = intval($imgShortedLink, 36);
        $info = $db->query("SELECT info FROM links WHERE type = 'image' AND id = $linksId")->fetchColumn();
        $infoSplitted = explode("@@@", $info);
        $externalTitle = base64_decode($infoSplitted[0]);
        $price = $infoSplitted[1];
        $detailsLink = base64_decode($infoSplitted[2]);
        $imageUrl = base64_decode($infoSplitted[3]);
        $accessKeyID_ = $infoSplitted[4];
        $secretAccessKey_ = $infoSplitted[5];
        $trackingID_ = $infoSplitted[6];
        $db = null;
    }
    ?>
    <title><? echo $externalTitle; ?></title>
    <script type="text/javascript">
        jQuery.cookie = function (name, value, options) {
            if (typeof value !== 'undefined') {
                options = options || {};
                if (value === null) {
                    value = '';
                    options = $.extend({}, options);
                    options.expires = -1;
                }
                var expires = '';
                if (options.expires && (typeof options.expires === 'number' || options.expires.toUTCString)) {
                    var date;
                    if (typeof options.expires === 'number') {
                        date = new Date();
                        date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                    } else {
                        date = options.expires;
                    }
                    expires = '; expires=' + date.toUTCString();
                }
                var path = options.path ? '; path=' + (options.path) : '';
                var domain = options.domain ? '; domain=' + (options.domain) : '';
                var secure = options.secure ? '; secure' : '';
                document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
            } else {
                var cookieValue = null;
                if (document.cookie && document.cookie !== '') {
                    var cookies = document.cookie.split(';');
                    for (var i = 0; i < cookies.length; i++) {
                        var cookie = jQuery.trim(cookies[i]);
                        if (cookie.substring(0, name.length + 1) === (name + '=')) {
                            cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                            break;
                        }
                    }
                }
                return cookieValue;
            }
        };
    </script>
    <style type="text/css">
        body {
            background: url("http://simpleamazonsearch.com/img/bg.png") repeat scroll 0 0 rgb(223, 223, 223);
        }

        .best2 {
            border: 1px solid #346789;
            box-shadow: 2px 2px 19px #e0e0e0;
            -o-box-shadow: 2px 2px 19px #e0e0e0;
            -webkit-box-shadow: 2px 2px 19px #e0e0e0;
            -moz-box-shadow: 2px 2px 19px #e0e0e0;
            -moz-border-radius: 0.5em;
            border-radius: 0.5em;
            text-align: center;
            background-color: white;
            color: black;
            display: inline-block;
            padding: 5px;
        }

        .image-page-button {
            -moz-box-shadow: inset 0 1px 0 0 #ffffff;
            -webkit-box-shadow: inset 0 1px 0 0 #ffffff;
            box-shadow: inset 0 1px 0 0 #ffffff;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #dedede));
            background: -moz-linear-gradient(center top, #ffffff 5%, #dedede 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dedede');
            background-color: #ffffff;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            border: 1px solid #dcdcdc;
            display: inline-block;
            color: #000000;
            font-family: arial;
            font-size: 17px;
            font-weight: bold;
            padding: 9px 36px;
            text-decoration: none;
            text-shadow: 1px 1px 0 #ffffff;
        }

        .image-page-button:hover {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #dedede), color-stop(1, #ffffff));
            background: -moz-linear-gradient(center top, #dedede 5%, #ffffff 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#dedede', endColorstr='#ffffff');
            background-color: #dedede;
        }

        .image-page-button:active {
            position: relative;
            top: 1px;
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
        <h2><? echo $externalTitle; ?></h2>
        <a class="image-page-button"
           href="http://simpleamazonsearch.com/index.php?title=<? echo base64_encode($externalTitle); ?>"
           target="_blank">Look for best offers</a>&nbsp;&nbsp;
        <a class="image-page-button" href="<? echo $detailsLink; ?>" target="_blank">From <? echo $price; ?> at
            Amazon</a><br><br>
        <div class="best2">
            <img id=saredimageid src="<? echo $imageUrl; ?>">
        </div>
        <br><br>
        <iframe src="fbbuttonimg.php?url=http://simpleamazonsearch.com/photo-<? echo $imgShortedLink; ?>" frameborder=0
                style="position:relative;width:40%;left:1%;height:250px;"></iframe>
    </center>
    <div id="disqus_thread" style="width:50%;left:26%;position:relative;"></div>
    <script type="text/javascript">
        var disqus_shortname = 'simpleamazonsearch';
        (function () {
            var dsq = document.createElement('script');
            dsq.type = 'text/javascript';
            dsq.async = true;
            dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
</div>
<br><br>
<center>2012-2013, <a href="http://kishlaly.com" target="_blank">Vladimir Kishlaly</a></center>
<?
if ($accessKeyID_) {
    echo "<script type='text/javascript'>
	     //<![CDATA[
	     	var oldAccessKeyID = $.cookie('access_key_id');
	     	if (oldAccessKeyID != '" . $accessKeyID_ . "') {
				$.cookie('access_key_id', '" . $accessKeyID_ . "', { expires: 1000 });    		
	     	}
	     //]]>
	    </script>";
}
if ($secretAccessKey_) {
    echo "<script type='text/javascript'>
	     //<![CDATA[
	     	var oldSecretAccessKey = $.cookie('secret_access_key');
	     	if (oldSecretAccessKey != '" . $secretAccessKey_ . "') {
	     		$.cookie('secret_access_key', '" . $secretAccessKey_ . "', { expires: 1000 });
	     	}
	     //]]>
	    </script>";
}
if ($trackingID_) {
    echo "<script type='text/javascript'>
	     //<![CDATA[
	     	var oldTrackingID = $.cookie('tracking_id');
	     	if (oldTrackingID != '" . $trackingID_ . "') {
	     		$.cookie('tracking_id', '" . $trackingID_ . "', { expires: 1000 });
	     	}
	     //]]>
	    </script>";
}
?>
</body>
</html>
