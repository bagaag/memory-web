<?php
require_once 'base.php';

$entries = array(
    createEntry('8th Grade', '8th-grade', 'event', array('School'), 'Unfortunately due to mitigating cirumstances, I cannot be bothered to present the facts.'),
    createEntry('1984 Pontiac Parisienne', '1984-parisienne', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Acton-Boxboro Regional High School', 'abrhs', 'place', array('School'), 'Twas the night before Christmas, when all through the house, not a creature was stirring.'),
    createEntry('Yokohama', 'yokohama', 'place', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('1980 Honda Civic', '1980-honda-civic', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
);

$entry = $entries[array_rand($entries)];

$scheme = $_SERVER['HTTPS'] != "" ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST']; 

header('Location: '.$scheme.'://'.$host.'/entry/'.$entry->slug);

?>
