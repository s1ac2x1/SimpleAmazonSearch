<?php
$link = $_POST['link'];

function get_bitly_short_url($url, $login = '', $appkey = '', $format = 'txt')
{
    $connectURL = 'http://api.bit.ly/v3/shorten?login=' . $login . '&apiKey=' . $appkey . '&uri=' . urlencode($url) . '&format=' . $format;
    return curl_get_result($connectURL);
}

function curl_get_result($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

if ($link) {
    echo get_bitly_short_url($link);
}

?>
