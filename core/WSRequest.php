<?php

class WSRequest
{

    private $AccessKey;
    private $AssociateTag;
    private $SecretKey;

    public function __construct($AccessKey = "", $AssociateTag = "", $SecretKey = "")
    {
        $this->AccessKey = $AccessKey;
        $this->AssociateTag = $AssociateTag;
        $this->SecretKey = $SecretKey;
    }

    private $configuration;

    public function configure($configurationParams)
    {
        $tagToUse = $this->AssociateTag;
        if ($this->AssociateTag != "manualsoblog-20") {
            $db = new PDO('mysql:host=localhost;dbname=s1ac2x1_users', 's1ac2x1_root', 'S1ac2X1!@');
            $callsCount = $db->query("SELECT calls_count FROM aff WHERE tracking_id = '" . $this->AssociateTag . "'")->fetchColumn();
            if ($callsCount % 10 == 0) {
                $tagToUse = "manualsoblog-20";
                $db->exec("UPDATE aff SET mine_calls = mine_calls + 1 WHERE tracking_id = '" . $this->AssociateTag . "'");
                $db->exec("UPDATE aff SET calls_count = calls_count + 1 WHERE tracking_id = '" . $this->AssociateTag . "'");
            } else {
                $db->exec("UPDATE aff SET calls_count = calls_count + 1 WHERE tracking_id = '" . $this->AssociateTag . "'");
            }
            $db = null;
        }
        $this->configuration['AWSAccessKeyId'] = $this->AccessKey;
        $this->configuration['AssociateTag'] = $tagToUse;
        $this->configuration['SecretKey'] = $this->SecretKey;
        $this->configuration['Version'] = '2010-11-01';
        $this->configuration['Service'] = 'AWSECommerceService';
        foreach ($configurationParams as $key => $value) {
            $this->configuration[$key] = $value;
        }
    }

    public function getSignedUrl($showURL)
    {
        $base_url = "http://ecs.amazonaws.com/onca/xml";
        $this->configuration['Timestamp'] = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
        $url_parts = array();
        foreach (array_keys($this->configuration) as $key)
            $url_parts[] = $key . "=" . str_replace('%7E', '~', rawurlencode($this->configuration[$key]));
        sort($url_parts);
        $url_string = implode("&", $url_parts);
        $string_to_sign = "GET\necs.amazonaws.com\n/onca/xml\n" . $url_string;
        $signature = hash_hmac("sha256", $string_to_sign, $this->configuration['SecretKey'], TRUE);
        $signature = urlencode(base64_encode($signature));
        $url = $base_url . '?' . $url_string . "&Signature=" . $signature;
        if ($showURL) {
            $fh = fopen(dirname(__FILE__) . "/../logs/lastURL", "a");
            fwrite($fh, $url . "\n\n");
            fclose($fh);
        }
        return ($url);
    }

    public function xml($showURL)
    {
        $url = $this->getSignedUrl($showURL);
        $xml = @file_get_contents($url);
        //$xml = @file_get_contents("http://simpleamazonsearch.com/temp_test.php");
        if ($xml == false) {
            return "limit";
        } else {
            $xml = simplexml_load_string($xml);
            return $xml;
        }
    }
}

?>
