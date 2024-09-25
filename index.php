<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetUrl = 'https://endlessdeposits.art/external_api/google-ads/update-stats';

    $jsonData = file_get_contents('php://input');
    $parameters = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Invalid JSON data received']);
        exit;
    }

    if (isset($parameters[0]['keywordText'])) {
        $targetUrl = 'https://endlessdeposits.art/external_api/google-ads/update-keywords-stats';
    }

    $queryString = http_build_query($parameters);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $targetUrl);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);

    $response = curl_exec($ch);

    if ($response === false) {
        echo json_encode(['error' => 'cURL Error: ' . curl_error($ch)]);
    } else {
        echo $response;
    }

    curl_close($ch);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
