<?php
include("../db.php");
foreach ($db->query("SELECT * FROM articles") as $row) {
    $title = base64_decode($row['title']);
    $content_ = base64_decode($row['content']);
    $exp = explode($title, $content_);
    $content = $exp[1];
    $leftItems = file_get_contents(dirname(__FILE__) . "/../cacheditems/cached/" . rand(1, 2952));
    $rightItems = file_get_contents(dirname(__FILE__) . "/../cacheditems/cached/" . rand(1, 2952));
    $mainContent = "<table>" .
        "<tr>" .
        "<td valign=\"top\" width=\"10%\">$leftItems</td>" .
        "<td valign=\"top\" width=\"80%\">$content</td>" .
        "<td valign=\"top\" width=\"10%\">$rightItems</td>" .
        "</tr>" .
        "</table>";
    $page = "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
			<script type=\"text/javascript\">
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-7412096-39']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
			</script>				
			<title>$title</title>
			<style type=\"text/css\">
			body {
				background: url(\"http://simpleamazonsearch.com/img/bg.png\") repeat scroll 0 0 rgb(223, 223, 223);
			}

			.top-items {
				border: 1px solid #346789;
				box-shadow: 2px 2px 19px #e0e0e0;
				-o-box-shadow: 2px 2px 19px #e0e0e0;
				-webkit-box-shadow: 2px 2px 19px #e0e0e0;
				-moz-box-shadow: 2px 2px 19px #e0e0e0;
				-moz-border-radius: 0.5em;
				border-radius: 0.5em;
				height: 180px;
				width: 180px;
				line-height: 5em;
				text-align: center;
				background-color: white;
				color: black;
				padding: 5px;
				margin: 5px;
				position:relative;
				float:left;
			}
			
			.top-items:hover {
				box-shadow: 2px 2px 19px #444;
				-o-box-shadow: 2px 2px 19px #444;
				-webkit-box-shadow: 2px 2px 19px #444;
				-moz-box-shadow: 2px 2px 19px #fff;
			}
			
			.mine {
				font-family: georgia, serif;
				color: black;
				font-size: 12pt;
				padding: 0 20px 15px;
			}
			
			
			</style>
			</head>
			<body>
			<!-- Quantcast Tag -->
			<script type=\"text/javascript\">
			var _qevents = _qevents || [];
			
			(function() {
			var elem = document.createElement('script');
			elem.src = (document.location.protocol == \"https:\" ? \"https://secure\" : \"http://edge\") + \".quantserve.com/quant.js\";
			elem.async = true;
			elem.type = \"text/javascript\";
			var scpt = document.getElementsByTagName('script')[0];
			scpt.parentNode.insertBefore(elem, scpt);
			})();
			
			_qevents.push({
			qacct:\"p-nFGwPq224qBaR\"
			});
			
			</script>
			<!-- End Quantcast tag -->
			<noscript>
			<div style=\"display:none;\">
			<img src=\"//pixel.quantserve.com/pixel/p-nFGwPq224qBaR.gif\" border=\"0\" height=\"1\" width=\"1\" alt=\"Quantcast\">
			</div>
			</noscript>
			<div id=\"external-shared-image\">
				<center>
					<a href=\"http://simpleamazonsearch.com\"><font face=\"Lucida Console\" style=\"font-size: 24pt\">Simple Amazon Search</font></a>
					<h2>$title</h2>
				</center>
				<center><div style=\"width:80%;text-align:left;\">$mainContent</div></center>
			</div>
			<br><br><center>2012-2013, <a href=\"http://kishlaly.com\" target=\"_blank\">Vladimir Kishlaly</a></center>
			</body>
			</html>";
    $fileNameToSave = str_replace(" ", "-", $title);
    $fileNameToSave = ereg_replace("[^A-Za-z0-9-]", "", $fileNameToSave);
    $fh = fopen(dirname(__FILE__) . "/../articles/" . $fileNameToSave . ".html", "w");
    fwrite($fh, $page);
    fclose($fh);
}
$db = null;
?>
