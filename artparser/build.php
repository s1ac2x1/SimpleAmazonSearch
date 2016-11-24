<?php
function curl_post($url, $data, & $info)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, curl_postData($data));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    $html = trim(curl_exec($ch));
    curl_close($ch);

    return $html;
}

function curl_postData($data)
{

    $fdata = "";
    foreach ($data as $key => $val) {
        $fdata .= "$key=" . urlencode($val) . "&";
    }

    return $fdata;

}

$url = 'http://articlebuilder.net/api.php';

$data = array();
$data['action'] = 'authenticate';
$data['format'] = 'php';

$data['username'] = '';
$data['password'] = '';

$output = unserialize(curl_post($url, $data, $info));

if ($output['success'] == 'true') {

    $session = $output['session'];
    $data = array();
    $data['session'] = $session;
    $data['format'] = 'php'; # You can also specify 'xml' as the format.
    $data['apikey'] = $apikey;
    $output = curl_post($url, $data, $info);
    $output = unserialize($output);
    $data['action'] = 'categories';
    $cats = curl_post($url, $data, $info);
    $cats = unserialize($cats);
    $category = $cats['output'][array_rand($cats['output'])];

    $data = array();
    $data['session'] = $session;
    $data['format'] = 'php'; # You can also specify 'xml' as the format.
    $data['action'] = 'buildArticle';
    $data['apikey'] = $apikey;
    $data['category'] = $category;
    $data['wordcount'] = 1000;
    $data['superspun'] = 2;
    $output = curl_post($url, $data, $info);
    $output = unserialize($output);

    if ($output['success'] == 'true') {
        $article = str_replace("\r", "<br>", str_replace("\n\n", "<p class='mine'>", $output['output']));
        $exp = explode("<p", $article);
        $articleTitle = $exp[0];
        include("../db.php");
        $db->exec("INSERT INTO articles (title, content) VALUES ('" . base64_encode($articleTitle) . "', '" . base64_encode($article) . "')");
        $db = null;
    } else {
        echo $output[error];
    }

} else {
    echo $output[error];
}
?>