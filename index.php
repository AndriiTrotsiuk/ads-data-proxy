<?php
// Target server and script where the request should be forwarded
$targetUrl = 'https://ads-data-script-623b11d8ced6.herokuapp.com/adsdata';

// Collect all the parameters from the current request's URI
$parameters = $_GET; // Using $_GET to handle query parameters

// Create a query string from the parameters
$queryString = http_build_query($parameters);

// Prepare the cURL session
$ch = curl_init();

// Set the target URL including the query string
curl_setopt($ch, CURLOPT_URL, $targetUrl . '?' . $queryString);

// Set options to return the response instead of outputting it directly
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Optionally handle POST requests as well
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
}

// Execute the cURL session
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Output the response from the target server
echo $response;
?>
