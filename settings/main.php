<?php
$fb_id = $_POST['fb_id'];

include("../db.php");
$q = $db->query("SELECT last_search_capacity, viewed_capacity FROM user_info WHERE fb_id = $fb_id");
$searchCapacity = $q->fetchColumn(0);
$viewedCapacity = $q->fetchColumn(1);
$db = null;
echo "<table width=\"100%\">" .
		"<tr>" .
			"<td width=\"48%\"><span class=\"settings-title\">Background</span></td>" .
			"<td width=\"48%\"><span class=\"settings-title\">History</span></td>" .
		"</tr>" .
		"<tr>" .
			"<td width=\"33%\" valign=\"top\">" .
				"<div id=\"user-background\">".
					"<input type=\"radio\" id=\"def-back\" name=\"user-back\" checked=\"checked\" onchange=\"showBackgroundsMenu();\" value=\"def-back-div\"/><label for=\"def-back\">Default</label>" .
					"<input type=\"radio\" id=\"cust-back\" name=\"user-back\" onchange=\"showBackgroundsMenu();\" value=\"cust-back-div\"/><label for=\"cust-back\">Current</label>" .
					"<input type=\"radio\" id=\"no-back\" name=\"user-back\" onchange=\"showBackgroundsMenu();\" value=\"no-back-div\"/><label for=\"no-back\">Without</label>
				</div><br>" .				
				"<div id=\"def-back-div\">" .
					"<center><span class=\"settings-content\" style=\"position:relative;bottom:10px;\">Press Save to set default background:</span>" .
					"<div class=\"user-background\"><center><img width=\"200px\" height=\"200px\" src=\"img/def-back-img.png\"></center></div></center>" .
				"</div>" .
				"<div id=\"cust-back-div\" style=\"display:none;\">" .
				"<center><div class=\"user-background\"><center><span id=\"back-img-pos\"><img id=\"settings-back-image\"></span></center></div></center><br>" .
				"<iframe id=\"backUploadIframe\" name=\"backUploadIframe\" src=\"settings/uploadform.php?id=$fb_id\" width=\"250\" height=\"120\" frameborder=\"no\"></iframe><br>" .
				"</div>".
				"<div id=\"no-back-div\" style=\"display:none;\">" .
					"<span class=\"settings-content\">Press Save to remove background (will be white)</span>" .
				"</div>".
			"</td>" .
			"<td valign=\"top\" width=\"33%\"><img src=\"img/prevsearch.png\" style=\"float:left;\"><br style=\"clear:both;\"><span class=\"settings-content\" style=\"position:relative;float:left;left:60px;top:-35px;\">Last searches menu:&nbsp;<span id=\"search-amount\"></span>&nbsp;keywords</span>" .
				"<br>" .
				"<div id=\"search-h-capacity\"></div>" .
				"<img src=\"img/viewhistory.png\" style=\"position:relative;float:left;left:-10px;\"><br style=\"clear:both;\"><span class=\"settings-content\" style=\"position:relative;float:left;left:60px;top:-43px;\">Last viewed:&nbsp;<span id=\"viewed-amount\"></span>&nbsp;items</span>" .
				"<br>" .
				"<div id=\"viewed-h-capacity\"></div><br>" .
				"</td>" .
		"</tr>" .
		"<tr><td>&nbsp;</td></tr>" .
	  "</table><br><div onclick=\"closeDiv('scroll-out');\" style=\"cursor:pointer;position:absolute;top:2px;right:2px;\"><img src=\"img/close_tr.png\"></div>" .
	  "<span id=\"settings-save-btn\" class=\"settings-save-btn\" onclick=\"saveSettings();\" style=\"margin-bottom:15px\">Save</span><br>" .
	  "<div id=\"search-capacity\" style=\"display:none;\">$searchCapacity</div>" .
	  "<div id=\"viewed-capacity\" style=\"display:none;\">$viewedCapacity</div>";
?>
