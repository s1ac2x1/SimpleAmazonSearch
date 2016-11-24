<?php
require_once(dirname(__FILE__) . "/../core/CacheHelper.php");

echo $uniqSHA1;
if (is_file(dirname(__FILE__) . "/../history/" . $uniqSHA1)) {
    echo "exists";
}
?>
