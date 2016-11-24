<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?
    $seo = $_GET['title'];
    if ($seo) {
        $seo = trim($seo);
        include("db.php");
        $info = $db->query("SELECT info FROM sitemap_offers WHERE type = 'item' AND url = '$seo'")->fetchColumn();
        $infoSplitted = explode("@@@", $info);
        $externalTitle = base64_decode($infoSplitted[0]);
        $price = $infoSplitted[1];
        $detailsLink = base64_decode($infoSplitted[2]);
        $imageUrl = base64_decode($infoSplitted[3]);
        $review = base64_decode($infoSplitted[4]);
        $db = null;
    }
    ?>
    <meta name="description" content="<? echo $review; ?>"/>
    <title><? echo $externalTitle; ?> - quick info</title>
    <style type="text/css">
        body {
            background: url("../img/bg.png") repeat scroll 0 0 rgb(223, 223, 223);
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
            -moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
            -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
            box-shadow: inset 0px 1px 0px 0px #ffffff;
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
            text-shadow: 1px 1px 0px #ffffff;
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
<div id="external-shared-image">
    <center>
        <a href="http://simpleamazonsearch.com"><font face="Lucida Console" style="font-size: 24pt">Simple Amazon
                Search</font></a><br>
        <font face="Lucida Console" style="font-size: 14pt;position:relative;top:5px;">short item info:</font>
        <h2><? echo $externalTitle; ?></h2>
        <table>
            <tr>
                <td valign="top" align="center">
                    <div class="best2">
                        <img src="<? echo $imageUrl; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top" align="center">
                    <div class="best2" style="width:40%;"><? echo $review; ?></div>
                </td>
            </tr>
        </table>
        <br>
        <a class="image-page-button"
           href="http://simpleamazonsearch.com/index.php?title=<? echo base64_encode($externalTitle); ?>"
           target="_blank">Look for best offers</a>&nbsp;&nbsp;
        <a class="image-page-button" href="<? echo $detailsLink; ?>" target="_blank">From <? echo $price; ?> at
            Amazon</a><br><br>
        <iframe src="fbbuttonimg.php?url=http://simpleamazonsearch.com/offers-<? echo $seo; ?>" frameborder=0
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
</body>
</html>