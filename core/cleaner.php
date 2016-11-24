<?php
function countFiles($folder)
{
    return iterator_count(new DirectoryIterator($folder)) - 2;
}

function folderFilesSize($folder)
{
    $result = 0;
    $iterator = new DirectoryIterator($folder);
    foreach ($iterator as $fileinfo) {
        if ($fileinfo->isFile()) {
            $result += filesize($folder . "/" . $fileinfo->getFilename());
        }
    }
    return $result;
}

function deleteFolder($folder)
{
    foreach (glob($folder . '/*') as $file) {
        if (is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($folder);
}

$filesCount = 0;
$filesSize = 0;

$logFolder = dirname(__FILE__) . "/../cache/base_search";
$dates_ = scandir($logFolder);
$dates = array_slice($dates_, 2, count($dates_));
foreach ($dates as $folder) {
    $interest = $logFolder . "/" . $folder;
    if (is_dir($interest)) {
        if (filemtime($interest) < strtotime("-30 minutes")) {
            $filesCount += countFiles($interest);
            $filesSize += folderFilesSize($interest);
            deleteFolder($interest);
        }
    }
}
$logFolder = dirname(__FILE__) . "/../cache/index_search";
$dates_ = scandir($logFolder);
$dates = array_slice($dates_, 2, count($dates_));
foreach ($dates as $folder) {
    $interest = $logFolder . "/" . $folder;
    if (is_dir($interest)) {
        if (filemtime($interest) < strtotime("-30 minutes")) {
            $filesCount += countFiles($interest);
            $filesSize += folderFilesSize($interest);
            deleteFolder($interest);
        }
    }
}
$logFolder = dirname(__FILE__) . "/../links";
$dates_ = scandir($logFolder);
$dates = array_slice($dates_, 2, count($dates_));
foreach ($dates as $folder) {
    $interest = $logFolder . "/" . $folder;
    if (is_dir($interest)) {
        if (filemtime($interest) < strtotime("-30 minutes")) {
            $filesCount += countFiles($interest);
            $filesSize += folderFilesSize($interest);
            deleteFolder($interest);
        }
    }
}
$logFolder = dirname(__FILE__) . "/../find";
$dates_ = scandir($logFolder);
$dates = array_slice($dates_, 2, count($dates_));
foreach ($dates as $file) {
    $interest = $logFolder . "/" . $file;
    if (is_file($interest)) {
        if (filemtime($interest) < strtotime("-30 minutes")) {
            $filesCount++;
            $filesSize += filesize($interest);
            unlink($interest);
        }
    }
}

$str = $filesCount . " old cache files with total size " . floor($filesSize / 1024) . " Kb has been deleted";

//mail("kishlaly.works@gmail.com", "SAS Cleanup", $str);
date_default_timezone_set('Europe/Kiev');
$currDate = date("d-m-Y_H-i");
$fh = fopen(dirname(__FILE__) . "/../logs/removed_cache", 'a');
fwrite($fh, $currDate . ": " . $str . "\n");
fclose($fh);

echo $currDate . ": " . $str;

?>
