<?php
$targetUrl = 'http://endlessdeposits.art/external/google-ads/update-stats';

$parameters = $_GET;

$jsonString = json_encode($parameters);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'JSON Encoding Error: ' . json_last_error_msg();
    exit;
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);

$response = curl_exec($ch);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
}

curl_close($ch);

echo $response;
?>
