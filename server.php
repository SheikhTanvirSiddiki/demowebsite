<?php
// Set the port and document root
$port = 3000;
$docRoot = __DIR__ . '/public';

// Function to serve static files
function serveStatic($filePath)
{
    if (file_exists($filePath)) {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $mimeTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'html' => 'text/html',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
        ];

        $mimeType = $mimeTypes[$fileExtension] ?? 'text/plain';

        header('Content-Type: ' . $mimeType);
        readfile($filePath);
        exit;
    }
}

// Main route
if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.html') {
    $filePath = __DIR__ . '/index.html';
    serveStatic($filePath);
}

// Static file handler for the 'public' directory
$filePath = $docRoot . $_SERVER['REQUEST_URI'];
if (file_exists($filePath)) {
    serveStatic($filePath);
}

// Default 404 response
http_response_code(404);
echo "404 Not Found";
?>
