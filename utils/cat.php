<?
$id = $_GET['id'];
$fullPath = $_GET['fullPath'];
require_once(dirname(__FILE__) . "/core/WSRequest.php");
$wsRequest = new WSRequest();
$configuration = array(
    'Operation' => 'BrowseNodeLookup',
    'BrowseNodeId' => $id
);
$wsRequest->configure($configuration);
$url = $wsRequest->getSignedUrl(false);
$xml = file_get_contents($url);
$xml = simplexml_load_string($xml);
$baseNodeTitle = $xml->BrowseNodes->BrowseNode->Name;
$baseNodeId = $xml->BrowseNodes->BrowseNode->BrowseNodeId;
if ($fullPath) {
    $fullPath_ = base64_decode($fullPath) . ":::" . $baseNodeTitle;
} else {
    $fullPath_ = $baseNodeTitle;
}

echo $fullPath_ . "<br><br>";
$fh = fopen("parsedCatAgain", "a");
if ($xml->BrowseNodes->BrowseNode->Children->BrowseNode) {
    foreach ($xml->BrowseNodes->BrowseNode->Children->BrowseNode as $node) {
        echo "<a href=\"cat.php?id=" . $node->BrowseNodeId . "&fullPath=" . base64_encode($fullPath_) . "\" target=\"_blank\">" . $node->Name . "</a><br>";
        fwrite($fh, $fullPath_ . ":::" . $node->Name . "***" . $node->BrowseNodeId . "\n");
    }
}
fclose($fh);
sleep(1);
?>