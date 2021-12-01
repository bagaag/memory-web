<?php

// DEBUG controls css/js combinification, etc.
define('DEBUG', true);

// load composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// project files
foreach (glob(__DIR__ . "/util/*.php") as $filename) {
    require_once $filename;
}
foreach (glob(__DIR__ . "/models/*.php") as $filename) {
    require_once $filename;
}

// setup twig
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader(__DIR__ . '/views');
$twig = new Environment($loader);

// get page slug
$url = explode('/', http_server_var('REQUEST_URI') );
$slug = '';
if ( count ($url) > 1 ) {
    $slug = $url[1];
}
$qspos = strpos($slug, "?");
if ($qspos != FALSE) {
    $slug = substr($slug, 0, $qspos);
}
if ($slug == '') {
    $slug = "home";
}
