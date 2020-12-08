<?php
require_once __DIR__ . '/global.php';

// get page script or return 404 if not found
if ($slug == 'entry') {
    $_REQUEST['slug'] = $url[2];
}
$page = __DIR__ . '/controllers/' . $slug . '.php';
if (! file_exists($page) ) {
    http_response_code(404);
    echo("<h1>404</h1><p>Ruh roh. Couldn't find " . $slug . ".</p>");
    die();
}
// execute the targeted page
else {
    include ('controllers/' . $slug . '.php' );
}
?>
