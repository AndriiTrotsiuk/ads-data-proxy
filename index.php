<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetUrl = 'https://endlessdeposits.art/external_api/google-ads/update-keywords-stats';

    $jsonData = file_get_contents('php://input');

    $parameters = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'Invalid JSON data received';
        exit;
    }
} else {
    $targetUrl = 'https://endlessdeposits.art/external_api/google-ads/update-stats';

    $parameters = $_GET;

    if (isset($parameters['keywordText'])) {
        $targetUrl = 'https://endlessdeposits.art/external_api/google-ads/update-keywords-stats';
    }
}

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
