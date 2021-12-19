<?php
require_once 'base.php';

$entries = new Entries();
$entry = $entries->fromSlug($_REQUEST['slug']);

// set controller data
$data['entry'] = $entry;
$data['isNew'] = false;
$data['h1'] = 'Edit Entry';

echo $twig->render('edit.html.twig', $data);
?>
