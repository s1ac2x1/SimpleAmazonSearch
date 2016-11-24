<?php
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

$fb_id = $_POST['fb_id'];

$allowedExts = array(
    "jpg",
    "jpeg",
    "gif",
    "png"
);

$uploadForm = "
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

$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] < 5000000) && in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        //echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        echo "error";
    } else {
        if (file_exists("files/" . $_FILES["file"]["name"])) {
        } else {
            $randFileName = "files/" . CacheHelper::gen_uuid();
            move_uploaded_file($_FILES["file"]["tmp_name"], $randFileName);
            $storedIn = $randFileName;
            include("../db.php");
            $background = base64_encode(file_get_contents($storedIn));
            $db->query("UPDATE user_info SET background  = '$background' WHERE fb_id = $fb_id");
            $db = null;
            echo $uploadForm;
            echo "<script type='text/javascript'> 
			     //<![CDATA[
					window.parent.refreshBackImageInSettings(true);
			     //]]>
			    </script>";
        }
    }
} else {
    echo $uploadForm;
    echo "<script type='text/javascript'> 
			     //<![CDATA[
					window.parent.refreshBackImageInSettings(false);
			     //]]>
			    </script>";

}
?>