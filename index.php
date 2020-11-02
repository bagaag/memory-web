<?php
// load composer dependencies
$docroot = __DIR__;
require $docroot . '/vendor/autoload.php';

// setup twig
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader($docroot . '/views');
$twig = new Environment($loader);

// get page slug
$url = explode('/', $_SERVER['REQUEST_URI']);
$slug = $url[1];
$qspos = strpos($slug, "?");
if ($qspos != FALSE) {
    $slug = substr($slug, 0, $qspos);
}
if ($slug == '') {
    $slug = "home";
}

// get page script or return 404 if not found
$page = __DIR__ . '/controllers/' . $slug . '.php';
if (! file_exists($page) ) {
    http_response_code(404);
    echo("<h1>404</h1><p>Ruh roh. Couldn't find " . $slug . ".</p>");
    die();
}
// execute the targeted page
else {
    include ('controllers/base.php');
    include ('controllers/' . $slug . '.php' );
}
?>
