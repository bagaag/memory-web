<?php
require_once 'base.php';

// get the entry
$entry = new Entry();
$entry->slug = $_REQUEST['slug'];
$entry->name = ucwords($_REQUEST['slug']);
$entry->start = new DateTime();
$entry->address = '18 Hamilton Rd, Arlington, MA';  
$entry->tags = array('Fred','Susan','Willa Jean');
$entry->description = "She didn't understand how changed worked. When she looked at today compared to yesterday, there was nothing that she could see that was different. Yet, when she looked at today compared to last year, she couldn't see how anything was ever the same.\n\nI haven't bailed on writing. Look, I'm generating a random paragraph at this very moment in an attempt to get my writing back on track. I am making an effort. I will start writing consistently again!\n\nYou know that tingly feeling you get on the back of your neck sometimes? I just got that feeling when talking with her. You know I don't believe in sixth senses, but there is something not right with her. I don't know how I know, but I just do.</p><p>He ordered his regular breakfast. Two eggs sunnyside up, hash browns, and two strips of bacon. He continued to look at the menu wondering if this would be the day he added something new. This was also part of the routine. A few seconds of hesitation to see if something else would be added to the order before demuring and saying that would be all. It was the same exact meal that he had ordered every day for the past two years.";
$entry->type->set(EntryType::PERSON);
$entry->attachments[sizeof($entry->attachments)] = new Attachment(0, 'Some File', 'some-file', 'jpg');
$entry->attachments[sizeof($entry->attachments)] = new Attachment(1, 'Another File', 'some-file', 'jpg');
$entry->attachments[sizeof($entry->attachments)] = new Attachment(2, 'Some Other File', 'some-file', 'jpg');
$entry->attachments[sizeof($entry->attachments)] = new Attachment(3, 'A really sweet file', 'some-file', 'jpg');
$entry->attachments[sizeof($entry->attachments)] = new Attachment(4, 'Going Bananas Limousine Service', 'some-file', 'jpg');

// set controller data
$data['entry'] = $entry;
$data['isNew'] = false;
$data['h1'] = 'Edit Entry';

echo $twig->render('edit.html.twig', $data);
?>
