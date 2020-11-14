<?php
require_once 'base.php';

// create a new entry
$entry = new Entry();

// see if a type was specified on the query string; defaults to event
$type = http_get_var('type');
if ($type != '') {
    $entry->type = new EntryType($type);
}
$type = $entry->type->get();

// set controller data
$data['entry'] = $entry;
$data['isNew'] = true;
$data['h1'] = 'New Entry';

echo $twig->render('edit.html.twig', $data);
?>
