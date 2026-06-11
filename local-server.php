<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$file = __DIR__ . '/public' . $uri;

if ($uri !== '/' && is_file($file)) {
    $type = mime_content_type($file) ?: 'application/octet-stream';
    header('Content-Type: ' . $type);
    readfile($file);
    return true;
}

require_once __DIR__ . '/public/index.php';
