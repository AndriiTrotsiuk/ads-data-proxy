<?php
// Target server and script where the request should be forwarded
$targetUrl = 'http://127.0.0.1/external/google-ads/update-stats';

// Collect all the parameters from the current request's URI
$parameters = $_GET; // Using $_GET to handle query parameters

// Create a query string from the parameters
$queryString = http_build_query($parameters);

// Prepare the cURL session
$ch = curl_init();

// Set the target URL (without the query string for PUT requests)
curl_setopt($ch, CURLOPT_URL, $targetUrl);

// Set options to return the response instead of outputting it directly
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set the HTTP method to PUT
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

// Set the data to be sent in the body of the PUT request
curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);

// Execute the cURL session
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
}

// Close the cURL session
curl_close($ch);

// Output the response from the target server
echo $response;
?>
