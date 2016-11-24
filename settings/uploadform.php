<?
$fb_id = $_GET['id'];
echo "
	<center>
		<div style=\"font-family: georgia, serif; font-size: 12pt; font-weight: bold; color: #2a2a2a;\">
			<form id=\"uploadBackgroundForm\" name=\"uploadBackgroundForm\" action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
				Select file:<br>
				<input type=\"file\" name=\"file\" id=\"file\"><br>
				<input type=\"hidden\" name=\"fb_id\" value=\"$fb_id\"><br>
				<input type=\"button\" value=\"Upload\" onclick=\"window.parent.settingsBackUpdate();document.uploadBackgroundForm.submit();\">
			</form>
		</div>
	</center>";
?>

	
	