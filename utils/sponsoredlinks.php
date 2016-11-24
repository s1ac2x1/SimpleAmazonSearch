<?
include("db.php");$result = "<table>";foreach ($db->query("SELECT url FROM sitemap_offers AS r1 JOIN (SELECT (RAND() * (SELECT MAX(id) FROM sitemap_offers)) AS id) AS r2 WHERE r1.id >= r2.id ORDER BY r1.id ASC LIMIT 5") as $row) {	$url = $row['url'];	$urlTitle = str_replace("-", " ", $url);	$result .= "<tr><td><a href='http://simpleamazonsearch.com/offers-$url'>$urlTitle</a></td></tr>";}

$db = null;
$result .= "</table>";echo $result;
?>