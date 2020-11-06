<?php

$entry = new Entry();

$type = $_GET["type"];
if ($type != '') {
    $entry->type = new EntryType($type);
}
$type = $entry->type->get();

$data['entry'] = $entry;
$data['isNew'] = true;
$data['h1'] = 'New ' . ucfirst($type);

echo $twig->render('edit.html.twig', $data);
?>