<?php

function compress($buffer)
{
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

$files = array("style/main.css",
    "js/figlet.js", "js/figloader.js", "js/jquery.mousewheel.js", "js/main.js");

foreach ($files as $file) {
    if (strpos($file, ".js") > -1) {
        $minName = str_replace(".js", ".min.js", $file);
    }
    if (strpos($file, ".css") > -1) {
        $minName = str_replace(".css", ".min.css", $file);
    }
    $content = file_get_contents($file);
    $content = compress($content);
    $fh = fopen($minName, "w");
    fwrite($fh, $content);
    fclose($fh);
    echo $file . " - > " . $minName . "<br>";
}

?>