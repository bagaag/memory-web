<?php
require_once 'base.php';

// get the entry
$entries = new Entries();
$slug = $_REQUEST['slug'];
$entry = $entries->fromSlug($slug);

// set controller data
$data['entry'] = $entry;
$data['h1'] = $entry->name;

echo $twig->render('entry.html.twig', $data);
?>
