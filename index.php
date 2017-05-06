<?
header('Content-type: text/html; charset=UTF-8');
include("db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-7412096-39']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' === document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <?
    error_reporting(0);
    session_start();
    $external = $_GET['external'];
    $extTitle = $_GET['title'];

    $urlKey = $_GET['urlKey'];
    if ($urlKey) {
        $urlKey = str_replace("-", " ", $urlKey);
        $titleFromKeyword = ucwords($urlKey);
    }

    $metaDesc = "Fast, free and simple tool to find the cheapest offers and most popular item's accessories. Try it out, it's cool!";
    $metaKeywords = "simple amazon search";

    if ($external) {
        $linksId = intval($external, 36);
        $info = $db->query("SELECT info FROM links WHERE type = 'item' AND id = $linksId")->fetchColumn();
        $infoSplitted = explode("@@@", $info);
        $externalTitle = base64_decode($infoSplitted[0]);
        $price = $infoSplitted[1];
        $accessKeyID_ = $infoSplitted[3];
        $secretAccessKey_ = $infoSplitted[4];
        $trackingID_ = $infoSplitted[5];
        echo "<title>$externalTitle, best offers</title>";
    } else if ($extTitle) {
        echo "<title>" . urldecode(base64_decode($extTitle)) . " - Best offers</title>";
    } else {
        if ($titleFromKeyword) {
            echo "<title>$titleFromKeyword - TOP 10 Amazon offers of $titleFromKeyword</title>";
            $metaDesc = "Looking for the cheapest $titleFromKeyword? We've already done this for you. " . $metaDesc;
            $metaKeywords .= ", " . $titleFromKeyword;
        } else {
            echo "<title>Simple Amazon Search - Just type in keyword and find out the most popular and cheapest items</title>";
        }
    }
    ?>
    <meta name="description" content="<? echo $metaDesc; ?>">
    <meta name="keywords" content="<? echo $metaKeywords; ?>"/>
    <link rel="stylesheet" type="text/css" href="style/main.min.css">
    <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.10.0.custom.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/figlet.js" type="text/javascript"></script>
    <script src="js/figloader.js" type="text/javascript"></script>
    <script src="js/jquery.mousewheel.js" type="text/javascript"></script>
    <script src="js/jquery.jscrollpane.min.js" type="text/javascript"></script>
    <script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="js/jquery.poshytip.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="facebook/js/oauthpopup.js"></script>
    <script type="text/javascript">

        var a2a_config = a2a_config || {};
        a2a_config.num_services = 20;

        var myFiglet = new Figlet();
        FigletLoader.load(myFiglet, "js/banner.flf", function (data) {
            myFiglet.load(data);
        });
        $(document).ready(function () {
            $('#facebook').click(function (e) {
                $.oauthpopup({
                    path: 'facebook/login.php',
                    width: 600,
                    height: 300,
                    callback: function () {
                        window.location.reload();
                    }
                });
                e.preventDefault();
            });
        });
        $(function () {
            $("#dialog-need-login").dialog({
                resizable: false,
                height: 200,
                width: 450,
                modal: true,
                autoOpen: false,
                buttons: {
                    "Login": function () {
                        $(this).dialog("close");
                        $.oauthpopup({
                            path: 'facebook/login.php',
                            width: 600,
                            height: 300,
                            callback: function () {
                                window.location.reload();
                            }
                        });
                    },
                    Cancel: function () {
                        $(this).dialog("close");
                    }
                }
            });
            $("#dialog-remove-fav").dialog({
                resizable: false,
                height: 200,
                width: 450,
                modal: true,
                autoOpen: false,
                buttons: {
                    Cancel: function () {
                        $(this).dialog("close");
                    },
                    "Remove": function () {
                        $(this).dialog("close");
                        $("#scroll-out").html("");
                        removeFavConfirmed();
                    }
                }
            });
            $("#dialog-welcome-info").dialog({
                resizable: false,
                modal: true,
                autoOpen: false,
                buttons: {
                    Ok: function () {
                        $(this).dialog("close");
                    }
                }
            });
        });

        function blink(selector) {
            $(selector).fadeOut('slow', function () {
                $(this).fadeIn('slow', function () {
                    blink(this);
                });
            });
        }

        function pageLoaded() {
            $('#keyword').focus();
            $('#category').keyup(function (event) {
                clearTimeout($.data(this, 'timer'));
                var wait = setTimeout(liveSearch, 500);
                $(this).data('timer', wait);
            });
            $('#category').click(function (event) {
                clearTimeout($.data(this, 'timer'));
                var wait = setTimeout(liveSearch, 500);
                $(this).data('timer', wait);
            });
            $('#default').prop("checked", "checked");
            $("#search-mode").buttonset();
            $("#facebook_logo").poshytip({
                className: 'tip-twitter',
                showTimeout: 1,
                alignTo: 'target',
                alignX: 'center',
                alignY: 'bottom',
                offsetY: 5,
                allowTipHover: false
            });
            $("#chrome_logo").poshytip({
                className: 'tip-twitter',
                showTimeout: 1,
                alignTo: 'target',
                alignX: 'center',
                alignY: 'bottom',
                offsetY: 5,
                allowTipHover: false
            });
            $("#firefox_logo").poshytip({
                className: 'tip-twitter',
                showTimeout: 1,
                alignTo: 'target',
                alignX: 'center',
                alignY: 'bottom',
                offsetY: 5,
                allowTipHover: false
            });
            console.log($.cookie('access_key_id'));
            console.log($.cookie('secret_access_key'));
            console.log($.cookie('tracking_id'));
        }

    </script>
</head>
<body onLoad="pageLoaded();">
<!-- Quantcast Tag -->
<script type="text/javascript">
    var _qevents = _qevents || [];

    (function () {
        var elem = document.createElement('script');
        elem.src = (document.location.protocol === "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
        elem.async = true;
        elem.type = "text/javascript";
        var scpt = document.getElementsByTagName('script')[0];
        scpt.parentNode.insertBefore(elem, scpt);
    })();

    _qevents.push({
        qacct: "p-nFGwPq224qBaR"
    });

</script>
<!-- End Quantcast tag -->
<noscript>
    <div style="display:none;">
        <img src="//pixel.quantserve.com/pixel/p-nFGwPq224qBaR.gif" border="0" height="1" width="1" alt="Quantcast">
    </div>
</noscript>
<div id="wrapper">
    <div style="text-align: center;">
        <?php
        require_once(dirname(__FILE__) . "/core/CacheHelper.php");
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }


        $header = "<div id=\"input-div\" class=\"input-div\">";

        if (!isset($_SESSION['User']) && empty($_SESSION['User'])) { ?>
            <div style="margin:10px;">
                <a href="#" style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;"
                   id="facebook"><img src="img/facebook_logo.png" width="64" height="64" alt="Login with Facebook"
                                      style="border:none;" id="facebook_logo" title="Login with Facebook"></a>&nbsp;&nbsp;
                <a target="_blank"
                   href="https://chrome.google.com/webstore/detail/simple-amazon-search/dhjmfejgbfclhkkhoflfbdnchbneeobg"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;"><img
                        src="img/chrome_logo.png" width="64" height="64" alt="Chrome extension" style="border:none;"
                        id="chrome_logo" title="Free Chrome extension"></a>&nbsp;&nbsp;
                <a target="_blank" href="https://addons.mozilla.org/en-US/firefox/addon/simple-amazon-search/"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;"><img
                        src="img/firefox_logo.png" width="64" height="64" style="border:none;" alt="Firefox extension"
                        id="firefox_logo" title="Free Firefox extension"></a>&nbsp;&nbsp;
                <a class="a2a_dd"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;" id="a2a_dd"
                   target="_blank"><img src="img/share.png" width="64" height="64" border="0" alt="Share"
                                        title="Share with friends"></a><br>
                <script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>
                <a href="http://simpleamazonsearch.com"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;">Home</a>&nbsp;&nbsp;
                <a href="#" onclick="showWelcomeInfo();"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;">How it
                    works</a>&nbsp;&nbsp;
                <a href="terms.html"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;">Terms</a>&nbsp;&nbsp;
                <a href="policy.html"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;">Privacy
                    Policy</a>&nbsp;&nbsp;
                <a target="_blank" href="http://mac.softpedia.com/progClean/Simple-Amazon-Search-Clean-130136.html"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;">Softpedia
                    "100% Free" Award</a>&nbsp;&nbsp;
                <a href="makemoney.htm"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: red;">Make money with
                    us</a>&nbsp;&nbsp;
                <a href="http://simpleamazonsearch.com/articles/"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;">Articles</a>&nbsp;&nbsp;
                <a href="http://simpleamazonsearch.com/sitemap/links-1.html"
                   style="font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;">Sitemap</a>
            </div>
        <?php } else {
            $header = "	<a target=\"_blank\" href=\"https://chrome.google.com/webstore/detail/simple-amazon-search/dhjmfejgbfclhkkhoflfbdnchbneeobg\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\"><img src=\"img/chrome_logo.png\" width=\"64\" height=\"64\" alt=\"Chrome extension\" style=\"border:none;\" id=\"chrome_logo\" title=\"Free Chrome extension\"></a>&nbsp;&nbsp;
			<a target=\"_blank\" href=\"https://addons.mozilla.org/en-US/firefox/addon/simple-amazon-search\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\"><img src=\"img/firefox_logo.png\" width=\"64\" height=\"64\" alt=\"Firefox extension\" style=\"border:none;\" id=\"firefox_logo\" title=\"Free Firefox extension\"></a>&nbsp;&nbsp;
			<a class=\"a2a_dd\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\" id=\"a2a_dd\" target=\"_blank\"><img src=\"img/share.png\" width=\"64\" height=\"64\" border=\"0\" alt=\"Share\" title=\"Share with friends\"></a><br>
			<script type=\"text/javascript\" src=\"http://static.addtoany.com/menu/page.js\"></script>	
			<a href=\"http://simpleamazonsearch.com\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\">Home</a>&nbsp;&nbsp;
			<a href=\"#\" onclick=\"showWelcomeInfo();\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\">How it works</a>&nbsp;&nbsp;
			<a href=\"terms.html\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\">Terms</a>&nbsp;&nbsp;
			<a href=\"policy.html\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\">Privacy Policy</a>&nbsp;&nbsp;
			<a target=\"_blank\" href=\"http://mac.softpedia.com/progClean/Simple-Amazon-Search-Clean-130136.html\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\">Softpedia \"100% Free\" Award</a>&nbsp;&nbsp;
			<a href=\"makemoney.htm\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: red;\">Make money with us</a>&nbsp;&nbsp;
			<a href=\"http://simpleamazonsearch.com/articles/\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\">Articles</a>&nbsp;&nbsp;
			<a href=\"http://simpleamazonsearch.com/sitemap/links-1.html\" style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: 14px;color: #000000;\">Sitemap</a>
	<div id=\"input-div\" class=\"input-div\">";
            $num = $db->query("SELECT count(*) as num FROM user_info WHERE fb_id = '" . $_SESSION['User']['id'] . "'")->fetchColumn();
            $links = "<span id=\"open-hide-fav\" class=\"example-search\" onclick='favorites();'>favorites</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;" .
                "<span id=\"open-hide-stats\" class=\"example-search\" onclick='userStats();'>statistics</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;" .
                "<span id=\"open-hide-stats\" class=\"example-search\" onclick='settings();'>personal settings</span>";

            $header .= "<span id=\"prev-search\" class=\"prev-search\"><img src=\"img/wait.gif\"></span>";
            $header .= "<span id=\"last-viewed\" class=\"viewed-history-btn2\"><img src=\"img/wait.gif\"></span>";

            if ($num > 0) {
                $date1 = date("Y-m-d");
                foreach ($db->query("SELECT * FROM user_info WHERE fb_id = " . $_SESSION['User']['id']) as $row) {
                    $date2 = $row['last_visit'];
                    $searchCapacity = $row['last_search_capacity'];
                    $viewedCapacity = $row['viewed_capacity'];
                    $userBackground = $row['background'];
                }

                $diff = abs(strtotime($date2) - strtotime($date1));

                $days = CacheHelper::days($date1) - CacheHelper::days($date2);

                $name = $_SESSION['User']['name'];

                $greetingsSrray = array("We are glad to see you, $name", "Hi, $name!", "Welcome back, " . $name);
                $randGreeting = $greetingsSrray[array_rand($greetingsSrray)];

                if ($days > 7) {
                    $header .= "<span class=\"userName\">Wow, $name! You were absent for $days days.. I'm so glad to see you back!</span>&nbsp;&nbsp;&nbsp;<a href=\"http://simpleamazonsearch.com/facebook/logout.php\">not you?</a><br>" . $links;
                } else {
                    $header .= "<span class=\"userName\">$randGreeting</span>&nbsp;&nbsp;&nbsp;<a href=\"http://simpleamazonsearch.com/facebook/logout.php\">not you?</a><br>" . $links;
                }

                $db->query("UPDATE user_info SET last_visit = now() WHERE fb_id = " . $_SESSION['User']['id']);

                if (strlen($userBackground) > 10) {
                    echo "<script type='text/javascript'>
		     //<![CDATA[
				$('body').css('background', 'url(http://simpleamazonsearch.com/settings/showimg.php?id=" . $_SESSION['User']['id'] . ") repeat scroll 0 0');
		     //]]>
		    </script>";
                } else {
                    echo "<script type='text/javascript'>
		     //<![CDATA[
				$('body').css('background', 'white');
		     //]]>
		    </script>";
                }
            } else {
                $header .= "<span class=\"userName\">Hey, " . $_SESSION['User']['name'] . "! Nice to meet you!</span>&nbsp;&nbsp;&nbsp;<a href=\"http://simpleamazonsearch.com/facebook/logout.php\">not you?</a><br>" . $links;
                $safeName = base64_encode($_SESSION['User']['name']);
                $date1 = date("Y-m-d");
                $background = base64_encode(file_get_contents("http://simpleamazonsearch.com/img/bg.png"));
                $db->exec("INSERT INTO user_info (fb_id, last_visit, ip, name, first_visit, default_background, background, email) VALUES (" . $_SESSION['User']['id'] . ", now(), '" . $ip . "', '$safeName', '$date1', '$background', '$background', '" . $_SESSION['User']['email'] . "')");
            }
            echo "<script type='text/javascript'> 
	     //<![CDATA[
			fb_id = '" . $_SESSION['User']['id'] . "';
			searchCapacity = '" . $searchCapacity . "';
			viewedCapacity = '" . $viewedCapacity . "';
	     //]]>
	    </script>";
            echo "<script type='text/javascript'>
	     //<![CDATA[
			populateSearchArrows(fb_id);
	     //]]>
	    </script>";
        }

        $catSelect = "<select id=\"categories-select\">
<option selected=\"selected\" value=\"Books\">Books</option>
<option value=\"Appliances\">Appliances</option>
<option value=\"ArtsAndCrafts\">Arts and crafts</option>
<option value=\"Automotive\">Automotive</option>
<option value=\"Baby\">Baby</option>
<option value=\"Beauty\">Beauty</option>
<option value=\"Apparel\">Apparel</option>
<option value=\"Collectibles\">Collectibles</option>
<option value=\"DigitalMusic\">Digital music</option>
<option value=\"DVD\">DVD</option>
<option value=\"Electronics\">Electronics</option>
<option value=\"Grocery\">Grocery</option>
<option value=\"HealthPersonalCare\">Health</option>
<option value=\"HomeGarden\">Home and garden</option>
<option value=\"Industrial\">Industrial</option>
<option value=\"Jewelry\">Jewelry</option>
<option value=\"KindleStore\">Kindle Store</option>
<option value=\"Kitchen\">Kitchen</option>
<option value=\"Magazines\">Magazines</option>
<option value=\"Miscellaneous\">Miscellaneous</option>
<option value=\"MobileApps\">Mobile applications</option>
<option value=\"MP3Downloads\">MP3 downloads</option>
<option value=\"Music\">Music</option>
<option value=\"MusicalInstruments\">Musical instruments</option>
<option value=\"MusicTracks\">Music tracks</option>
<option value=\"OfficeProducts\">Office products</option>
<option value=\"OutdoorLiving\">Outdoor</option>
<option value=\"PCHardware\">PC hardware</option>
<option value=\"PetSupplies\">Pet supplies</option>
<option value=\"Photo\">Photo</option>
<option value=\"Shoes\">Shoes</option>
<option value=\"Software\">Software</option>
<option value=\"SportingGoods\">Sporting goods</option>
<option value=\"Tools\">Tools</option>
<option value=\"Toys\">Toys</option>
<option value=\"UnboxVideo\">Unbox video</option>
<option value=\"VHS\">VHS</option>
<option value=\"Video\">Video</option>
<option value=\"VideoGames\">Video games</option>
<option value=\"Watches\">Watches</option>
<option value=\"WirelessAccessories\">Wireless accessories</option>
</select>";

        $favHTML = "<br><div id=\"scroll-out-load\" style=\"position:relative;\"></div><div id=\"scroll-out\" class=\"my-fav\" style=\"display:none;\"></div>";
        $header .= "<br><br><table style=\"position:relative;left:11px;width:100%;height:100%;\">
				<tr>
					<td align=\"center\" valign=\"top\" width=\"50%\">
						<table width=\"100%\">
							<tr>
								<td align=\"left\">
									<span style=\"position:relative;font-size:16pt;font-family: georgia, serif;color: #2a2a2a;\">Basic search</span>
									&nbsp;<span class=\"clear-field\" onclick='clearKeywordField();'>clear</span>
								</td>
							</tr>
							<tr>	
								<td align=\"left\">
									<input id=\"keyword\" class=\"keyword-highlighted\" type=\"text\" onclick=\"$('#keyword').css('background', 'white');\" onkeypress=\"$('#keyword').css('background', 'white'); if (event.keyCode==13) { printCircles(true); }\" style=\"margin-bottom:15px;width:95%;\"><br>
									<span style=\"position:relative;top:-12px;font-size:9pt;font-family: georgia, serif;color:#2a2a2a;\">eg.&nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('canon 18mp', 'keyword');\">canon 18mp</span>
							        &nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('barbie dolls', 'keyword');\">barbie dolls</span>
							        &nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('head mask', 'keyword');\">head mask</span>" .
            "&nbsp;&nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('wine cork holder', 'keyword');\">wine cork holder</span>" .
            "&nbsp;&nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('wedding rings', 'keyword');\">wedding rings</span></span><br>
									<span style=\"top:-10px;position:relative;font-size:10pt;font-family: 'Libre Baskerville', serif;color: #2a2a2a;\">We'll do best to find the most popular and cheapest new goods for that keyword</span>
								</td>
							</tr>		
						</table>		
					</td>
					<td align=\"center\" valign=\"top\" width=\"50%\">
						<table width=\"100%\">
							<tr>
								<td align=\"left\">
									<span style=\"position:relative;font-size:16pt;font-family: georgia, serif;color: #2a2a2a;\">Category live selection</span>
									&nbsp;<span class=\"clear-field\" onclick='clearCategoryField();'>clear</span>
								</td>
							</tr>
							<tr>	
								<td align=\"left\">
									<input id=\"category\" class=\"keyword-highlighted\" type=\"text\" style=\"margin-bottom:15px;width:95%\">
								</td>					
							</tr>
							<tr>
								<td align=\"left\"><span style=\"position:relative;top:-15px; font-size:9pt;font-family: georgia, serif;color: #2a2a2a;\">eg.&nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('cameras', 'category'); forceLiveSearch('cameras');\">cameras</span>
							        &nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('doll accessories', 'category'); forceLiveSearch('doll accessories');\">doll accessories </span>
							        &nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('masks', 'category'); forceLiveSearch('masks');\">masks</span>" .
            "&nbsp;&nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('business card cases', 'category'); forceLiveSearch('business card cases');\">business card cases</span>" .
            "&nbsp;&nbsp;&nbsp;<span class=\"example-search\" onclick=\"pastePhraseInSearch('wedding rings', 'category'); forceLiveSearch('wedding rings');\">wedding rings</span></span><br><span style=\"top:-13px;position:relative;font-size:10pt;font-family: 'Libre Baskerville', serif;color: #2a2a2a;\">For more accurate search and additional cool stuff you can specify an approximate category.</span>
				        		</td>
							</tr>									
						</table>		
					</td>
				</tr>
			</table>";
        $header .= "<div style=\"position:relative;top:-9px;\">" .
            "<br><div id=\"search-mode\"><span style=\"bottom:5px;position:relative;font-size:10pt;font-family: georgia, serif;color: #2a2a2a;\">	
				<b style=\"position:relative;bottom:12px;\">Search mode:</b><br>
				<input onchange=\"searchTypeChanged('default');\" type=\"radio\" name=\"searchMode\" value=\"default\" id=\"default\" checked>" .
            "<label for=\"default\" class=\"live-search-filter-checkbox-label-top\"><span class=\"radio-top-title\" id=\"top-radio-label-default\">Keyword and/or Category</span></label>&nbsp;
				<input onchange=\"searchTypeChanged('topsellers');\" type=\"radio\" name=\"searchMode\" value=\"topsellers\"  id=\"topsellers\">" .
            "<label for=\"topsellers\" class=\"live-search-filter-checkbox-label-top\"><span class=\"radio-top-title\" id=\"top-radio-label-topsellers\">Top Sellers</span></label>&nbsp;
				<input onchange=\"searchTypeChanged('mostwished');\" type=\"radio\" name=\"searchMode\" value=\"mostwished\"  id=\"mostwished\">" .
            "<label for=\"mostwished\" class=\"live-search-filter-checkbox-label-top\"><span class=\"radio-top-title\" id=\"top-radio-label-mostwished\">Most Wished items</span></label>&nbsp;
				<input onchange=\"searchTypeChanged('mostgifted');\" type=\"radio\" name=\"searchMode\" value=\"mostgifted\"  id=\"mostgifted\">" .
            "<label for=\"mostgifted\" class=\"live-search-filter-checkbox-label-top\"><span class=\"radio-top-title\" id=\"top-radio-label-mostgifted\">Most Gifted items</span></label>&nbsp;
				<input onchange=\"searchTypeChanged('newreleases');\" type=\"radio\" name=\"searchMode\" value=\"newreleases\" id=\"newreleases\">" .
            "<label for=\"newreleases\" class=\"live-search-filter-checkbox-label-top\"><span class=\"radio-top-title\" id=\"top-radio-label-newreleases\">New Releases</span></label>
				<input onchange=\"searchTypeChanged('incat');\" type=\"radio\" name=\"searchMode\" value=\"incat\" id=\"incat\">" .
            "<label for=\"incat\" style=\"position:relative;top:-3px;left:11px;cursor:pointer;font-family: 'Sorts Mill Goudy', serif;color:black;font-size:12pt;height:35px;\"><span style=\"position:relative;top:-1px;\" id=\"top-radio-label-incat\">Keyword and/or Category in $catSelect</span></label>
			</span></div>" .
            "<div class=\"cat-tip\"></div>" .
            "<span class=\"classname\" id=\"main-search-button\" onclick=\"printCircles(true);\" style=\"cursor:pointer;\">" .
            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .
            "</span>" .
            "<span class=\"description\" id=\"under-search-tip\"></span>" .
            "</div></div>";

        $today = date('l, jS \of F, Y');

        $bestItemsCount = $db->query("SELECT COUNT(*) c FROM best_cat")->fetchColumn();
        $currentBestItemsSummary = "<font style=\"font-family: georgia, serif; color: black; font-size: 12pt;\">$bestItemsCount products from 2300+ categories</font>";

        $header .= "<br><div class=\"input-div\" id=\"top-items-menu-outer-div\"><font style=\"font-family: georgia, serif; color: black; font-size: 18pt;\">Today's best offers</font><br>$currentBestItemsSummary<br><font style=\"font-family: verdana,arial,helvetica,sans-serif;font-size: small;color: #000000;\">$today</font><br><br><center>
<span id=\"top-menu-1\" class=\"top-menu-item\" onclick=\"bestCat('Books', 'Books', this);\">Books</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-2\" class=\"top-menu-item\" onclick=\"bestCat('Appliances', 'Appliances', this);\">Appliances</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-3\" class=\"top-menu-item\" onclick=\"bestCat('ArtsAndCrafts', 'Arts and crafts', this);\">Arts and crafts</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-4\" class=\"top-menu-item\" onclick=\"bestCat('Automotive', 'Automotive', this);\">Automotive</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-5\" class=\"top-menu-item\" onclick=\"bestCat('Baby', 'Baby', this);\">Baby</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-6\" class=\"top-menu-item\" onclick=\"bestCat('Beauty', 'Beauty', this);\">Beauty</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-7\" class=\"top-menu-item\" onclick=\"bestCat('Apparel', 'Apparel', this);\">Apparel</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-8\" class=\"top-menu-item\" onclick=\"bestCat('Collectibles', 'Collectibles', this);\">Collectibles</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-11\" class=\"top-menu-item\" onclick=\"bestCat('Electronics', 'Electronics', this);\">Electronics</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-12\" class=\"top-menu-item\" onclick=\"bestCat('Grocery', 'Grocery', this);\">Grocery</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-13\" class=\"top-menu-item\" onclick=\"bestCat('HealthPersonalCare', 'Health', this);\">Health</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-14\" class=\"top-menu-item\" onclick=\"bestCat('HomeGarden', 'Home and garden', this);\">Home and garden</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-15\" class=\"top-menu-item\" onclick=\"bestCat('Industrial', 'Industrial', this);\">Industrial</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-16\" class=\"top-menu-item\" onclick=\"bestCat('Jewelry', 'Jewelry', this);\">Jewelry</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-17\" class=\"top-menu-item\" onclick=\"bestCat('KindleStore', 'Kindle Store', this);\">Kindle Store</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-18\" class=\"top-menu-item\" onclick=\"bestCat('Kitchen', 'Kitchen', this);\">Kitchen</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-19\" class=\"top-menu-item\" onclick=\"bestCat('Magazines', 'Magazines', this);\">Magazines</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-21\" class=\"top-menu-item\" onclick=\"bestCat('MobileApps', 'Mobile applications', this);\">Mobile applications</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-22\" class=\"top-menu-item\" onclick=\"bestCat('MP3Downloads', 'MP3 downloads', this);\">MP3 downloads</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-23\" class=\"top-menu-item\" onclick=\"bestCat('Music', 'Music', this);\">Music</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-24\" class=\"top-menu-item\" onclick=\"bestCat('MusicalInstruments', 'Musical instruments', this);\">Musical instruments</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-26\" class=\"top-menu-item\" onclick=\"bestCat('OfficeProducts', 'Office products', this);\">Office products</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-27\" class=\"top-menu-item\" onclick=\"bestCat('OutdoorLiving', 'Outdoor', this);\">Sports & Outdoor</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-28\" class=\"top-menu-item\" onclick=\"bestCat('PCHardware', 'PC hardware', this);\">PC hardware</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-29\" class=\"top-menu-item\" onclick=\"bestCat('PetSupplies', 'Pet supplies', this);\">Pet supplies</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-31\" class=\"top-menu-item\" onclick=\"bestCat('Shoes', 'Shoes', this);\">Shoes</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-32\" class=\"top-menu-item\" onclick=\"bestCat('Software', 'Software', this);\">Software</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-34\" class=\"top-menu-item\" onclick=\"bestCat('Tools', 'Tools', this);\">Tools</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-35\" class=\"top-menu-item\" onclick=\"bestCat('Toys', 'Toys', this);\">Toys</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-37\" class=\"top-menu-item\" onclick=\"bestCat('Video', 'Video', this);\">Video</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-39\" class=\"top-menu-item\" onclick=\"bestCat('VideoGames', 'Video games', this);\">Video games</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
<span id=\"top-menu-40\" class=\"top-menu-item\" onclick=\"bestCat('Watches', 'Watches', this);\">Watches</span>&nbsp;<span class=\"ord\">&ordm;</span>&nbsp;
</center></div>";
        ?>
        <? echo $header . $favHTML; ?>
        <div id="live-search-div" class="live-search-div-hidden" style="position:relative;"></div>
        <div id="nodes-loader" style="display:none;"></div>
        <div id="nodes" class="base-item-info" style="display:none;position:relative;width:85%;"></div>
        <div id="history"></div>
        <div id="itemTipOuter" class="itemTip_">
            <div id="itemTip"></div>
        </div>
        <div id="itemTip2" class="itemTip_"></div>
        <div id="itemTip3" class="itemTip_"></div>
        <div id="itemTipFav" class="itemTip_"></div>
        <div id="itemTipRem" class="itemTip_"></div>
        <div id="circles" style="display: none;"></div>
        <div id="topItems" style="display:none;"></div>
        <div id="picturesMode" style="display:none;padding:10px;">
            <span style="font-weight: bold;">Preview type:</span>&nbsp;
            <span id="itemset-default" class="cat-part-selected" onclick="defaultPictures();">default pictures</span>&nbsp;
            <span id="itemset-big" class="cat-part-unselected" onclick="bigPictures();">big pictures</span>
            <span id="additional-options-for-big-items">
				&nbsp;&nbsp;&nbsp;
				<span style="font-weight: bold;">Sort by:</span>&nbsp;
				<span id="itemset-sort-price" class="cat-part-selected" onclick="itemsSortByPrice();">price</span>&nbsp;
				<span id="itemset-sort-offers" class="cat-part-unselected" onclick="itemsSortByOffers();">offers</span>
			</span>
        </div>
        <div id="baseSearchSummary" style="display:none;"></div>
        <div id="baseSearch" style="display: none;" class="baseSearch"></div>
        <div id="live-search-loader"></div>
        <div id="loader-from-history" style="position:absolute; margin-top:5px; left:44%;"></div>
        <div id="relatedItems" style="display: none;"></div>
        <div id="indexCircles" style="display: none;"></div>
        <div class="smallMargin" id="indexSearchTitle" style="display: none;"></div>
        <div id="indexSearch" style="display: none;" class="smallMargin"></div>
        <div id="baseItem" style="display: none; width:85%" class="smallMargin"></div>
        <br>
    </div>
    <div id="item-keyword" style="display: none;"></div>
    <div id="hidden-index-cache-collection" style="display: none;">0</div>
    <div id="prelarge"></div>
    <div id="dialog-need-login" title="Sorry" style="display:none;">
        This function is available for logged in users.<br>Do you want to login with Facebook now?
    </div>
    <div id="dialog-remove-fav" title="Really?" style="display:none;">
        Remove all favorites items?
    </div>
    <div id="welcome-info" style="display:none;width:60%;">
        <div class="input-div" style="z-index: 999;">
            <div style="text-align: center;">
                <table>
                    <tr>
                        <td align="left"><font style="font-family: georgia, serif; color: black; font-size: 18pt;">Proud
                                to present a special search in the largest store in the world - Amazon.com</font></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left"><span class="welcome-info" style="position:relative;top:-38px;">Each product has at least several sellers and many offers. For example:</span><img
                                src="img/w<? echo rand(1, 6); ?>.png" style="margin-left:10px;"
                                alt="Amazon results example">
                        <td>
                    </tr>
                    <tr>
                        <td><span
                                class="welcome-info">Enter  keyword, press search button and find out what you need.</span>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left"><span class="welcome-info">SimpleAmazonSearch guided by the internal evaluation mechanisms alogn with Amazon's products information</span>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="welcome-info">and filters for you only most popular and relevant offers from hundreds possible, without tedious searching:</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><img src="img/w.png" alt="Amazon offers example"></td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td align="center">
                            <font style="font-family: georgia, serif; color: black; font-size: 13pt;">
                                Many thanks to these people:</font><br><br>
                            <font style="font-family: georgia, serif; color: black; font-size: 11pt;">
                                <a href="http://www.w3.org/" target="_blank">World Wide Web Consortium</a> and <a
                                    target="_blank" href="http://www.w3.org/People/Berners-Lee/">Sir Timothy John
                                    Berners-Lee</a> for the HTML, CSS and Web standarts;<br><br>
                                <a target="_blank" href="http://lerdorf.com">Rasmus Lerdorf</a> for the <a
                                    href="http://www.php.net/" target="_blank">PHP</a>;<br><br>
                                <a target="_blank" href="http://monty-says.blogspot.com/">Michael Widenius</a> for the
                                <a target="_blank" href="http://www.mysql.com/">MySQL</a>;<br><br>
                                <a target="_blank" href="https://brendaneich.com/"> Brendan Eich</a> for the JavaScript;<br><br>
                                <a target="_blank" href="http://ejohn.org/">John Resig</a> for the <a target="_blank"
                                                                                                      href="http://jquery.com/">jQuery</a>;<br><br>
                                <span style="font-weight: bold;">and special thanks to</span><br><br>
                                Jeffrey Bezos for the <a target="_blank" href="http://amazon.com">Amazon</a> and <a
                                    target="_blank" href="http://aws.amazon.com/">Amazon Web Services</a>
                            </font>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div id="prev-search-content" class="arrow-history" style="display:none;"></div>
    <div id="last-viewed-content" class="arrow-history" style="display:none;"></div>
    <div id="temp-for-history" style="display: none;"></div>
    <div id="browseNodeId" style="display:none;"></div>
    <div id="browseNodeFullTitleEncoded" style="display:none;"></div>
    <div id="searchMode" style="display:none;"></div>
    <div id="keyword-clear-field" style="display:none;"></div>
    <div id="category-clear-field" style="display:none;"></div>
    <div id="external-shared-image" style="display:none;"></div>
</div>
<?
if ($external) {
    $externalTitle = strip_tags($externalTitle);
    $externalTitle = str_replace('"', "", $externalTitle);
    $externalTitle = str_replace("'", "", $externalTitle);
    $externalTitle = urldecode($externalTitle);

    echo "<script type='text/javascript'>
     //<![CDATA[
		$('#keyword').val('" . $externalTitle . "');
		printCircles(false);
     //]]>
    </script>";
}
if ($extTitle || $extSeo) {
    $key = base64_decode($extTitle);
    $key = strip_tags($key);
    $key = str_replace('"', "", $key);
    $key = str_replace("'", "", $key);
    $key = urldecode($key);
    echo "<script type='text/javascript'>
     //<![CDATA[
		$('#keyword').val('" . $key . "');
		printCircles(false);
     //]]>
    </script>";
}
$nick = $_GET['nick'];
if ($nick) {
    foreach ($db->query("SELECT * FROM aff WHERE nick = '$nick'") as $row) {
        $accessKeyID = $row['access_key_id'];
        $secretAccessKey = $row['secret_access_key'];
        $trackingID = $row['tracking_id'];
    }
    if ($trackingID) {
        echo "<script type='text/javascript'>
	     //<![CDATA[
			var accessKeyID = '" . $accessKeyID . "';
			var secretAccessKey = '" . $secretAccessKey . "';
			var trackingID = '" . $trackingID . "';
			$.cookie('access_key_id', accessKeyID, { expires: 1000 });
			$.cookie('secret_access_key', secretAccessKey, { expires: 1000 });
			$.cookie('tracking_id', trackingID, { expires: 1000 });
	     //]]>
	    </script>";
    }
} else {
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
}
if ($urlKey) {
    echo "<script type='text/javascript'>
     //<![CDATA[
		$('#keyword').val('" . $urlKey . "');
		printCircles(false);
     //]]>
    </script>";
}

$db = null;
?>
</body>
</html>
