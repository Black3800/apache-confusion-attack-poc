<?php

// Check if the filename parameter is set
if (!isset($_GET['file'])) {
    die("File parameter is required.");
}

// Parse the URL to get its host and path
$parsedUrl = parse_url('http://localhost/' . $_GET['file']);

// Restrict access to admin.php only when accessed from localhost
if (isset($parsedUrl['path']) && basename($parsedUrl['path']) === 'admin.php') {
    die("Access to admin.php is restricted on localhost.");
}

$uri = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $parsedUrl['path'];

// Initialize cURL session
$ch = curl_init($uri);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // Follow redirects if necessary

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    die("Error fetching file: " . curl_error($ch));
}

// Get content type and length from headers
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$contentLength = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

// Close cURL session
curl_close($ch);

// If file was not found or there was an issue with content length
if ($contentLength == -1) {
    die("File not found or error in fetching file.");
}

// Set appropriate headers for the file
header('Content-Type: ' . $contentType);
header('Content-Length: ' . $contentLength);

// Output the file content
var_dump($parsedUrl);
echo "\n\n";
echo $response;
exit;
?>
