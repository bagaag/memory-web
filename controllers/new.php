<?php
require_once 'base.php';

$entry = new Entry();

$type = http_get_var('type');
if ($type != '') {
    $entry->type = new EntryType($type);
}
$type = $entry->type->get();

$data['entry'] = $entry;
$data['isNew'] = true;
$data['h1'] = 'New Entry';

echo $twig->render('edit.html.twig', $data);
?>
