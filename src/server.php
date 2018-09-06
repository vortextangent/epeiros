<?php

if (isset($_REQUEST['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_REQUEST['HTTP_ORIGIN']}");
} else {
    header("Access-Control-Allow-Origin: *");
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Content-Type: text/plain charset=UTF-8");
    header("Content-Length: 0");
    header("HTTP/1.0 204 No Content", false, 204);
    //just a 'preflight' request so nothing else to do here.
    exit();
}

$request = $_SERVER['REQUEST_URI'];

$baseDir = __DIR__ . '/../public';

$fullPath = $baseDir . '/' . $_SERVER['REQUEST_URI'];

$fileexists = realpath($fullPath);

if (!empty($request) && $request !== '/') {
    if (($fileexists !== false)) {
        //readfile($fileexists);
        return false;
    }
}

require __DIR__ . '/../public/index.php';
