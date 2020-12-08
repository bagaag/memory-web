<?php
require_once 'base.php';

// create a new entry
$entry = new Entry();
$entry->slug = $_REQUEST['slug'];
$entry->name = ucwords($_REQUEST['slug']);
$entry->start = new DateTime();
$entry->address = '18 Hamilton Rd, Arlington, MA';  
$entry->tags = array('Fred','Susan','Willa Jean');
$entry->description = 'It was the best sandcastle he had ever seen. The tour bus was packed with teenage girls heading toward their next adventure. For the 216th time, he said he would quit drinking soda after this last Coke.';
$entry->type->set(EntryType::EVENT);
$entry->attachments[sizeof($entry->attachments)] = new Attachment('Some File', 'https://i.picsum.photos/id/1027/500/400.jpg?hmac=GqILk1kfnvOEXlTiag4sbI29QYYmcpEUe1Y-SdMNLfI');
$entry->attachments[sizeof($entry->attachments)] = new Attachment('Another File', 'https://i.picsum.photos/id/160/500/400.jpg?hmac=7Bq3fi-O4p6OCXuvL9tcATHI7r0u5L4a70_-kVr8vJw');

// set controller data
$data['entry'] = $entry;
$data['h1'] = $entry->name;

echo $twig->render('entry.html.twig', $data);
?>
