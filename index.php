<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // proxy.

$targetUrl = 'http://endlessdeposits.art/external/google-ads/update-stats';


$parameters = $_GET;

$queryString = http_build_query($parameters);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $targetUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);

$response = curl_exec($ch);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
}

curl_close($ch);

echo $response;
?>
