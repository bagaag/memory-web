<?php
require_once 'base.php';

$entries = new Entries();

// get request params and set defaults
$type = '';
if (array_key_exists('type', $_REQUEST)) {
    $type = $_REQUEST['type'];
}
$sort = 'modified';
if (array_key_exists('sort', $_REQUEST)) {
    $sort = $_REQUEST['sort'];
}
if ( ! array_key_exists('tags', $_REQUEST)) {
    $tags = array();
} else {
    $tags = explode(',', $_REQUEST['tags']);
}

$pager = new Pager(count($entries->all));
$pager->setRequestState();

// apply page

// set controller data
$data['h1'] = 'Browse';
$data['entries'] = $pager->slicePage($entries->all);
$params = array();
$params['type'] = $type;
$params['tags'] = $tags;
$params['sort'] = $sort;
$params['page'] = $pager->page;
$params['pages'] = $pager->pages;
$data['params'] = $params;

echo $twig->render('browse.html.twig', $data);
?>
