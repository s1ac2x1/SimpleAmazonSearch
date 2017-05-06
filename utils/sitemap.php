<?header("Content-type: text/xml"); 
include("db.php");
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";foreach ($db->query("SELECT url FROM sitemap_offers") as $row) {	$url = $row['url'];	$xml .= "<url><loc>http://simpleamazonsearch.com/offers-$url</loc><lastmod>2013-01-15T19:17:28+00:00</lastmod><priority>1.00</priority></url>";	
}

$db = null;
$xml .= "</urlset>";
echo $xml;
?>