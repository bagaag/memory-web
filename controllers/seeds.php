<?php
require_once 'base.php';

$seeds = array(
    createEntry('8th Grade', 'crumbumb', 'event', array('School'), 'Unfortunately due to mitigating cirumstances, I cannot be bothered to present the facts.'),
    createEntry('1984 Pontiac Parisienne', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Acton-Boxboro Regional High School', 'crumbumb', 'place', array('School'), 'Twas the night before Christmas, when all through the house, not a creature was stirring.'),
    createEntry('Yokohama', 'crumbumb', 'place', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('1980 Honda Civic', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Bagger at Triple A', 'crumbumb', 'event', array('Job'), 'Whenever people call me on the telephone, I hang up and ride my bicycle to visit them in person.'),
    createEntry('Nathan Maxwell', 'crumbumb', 'person', array('Friend','Japan'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Penelope Griswald', 'crumbumb', 'person', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Technical Writer at BeyondMail', 'crumbumb', 'event', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Crumbumb', 'crumbumb', 'thing', array('Fnoot'), 'Unfortunately due to mitigating cirumstances...'),
);

// set controller data
$data['h1'] = 'Seeds';
$data['seeds'] = $seeds;

echo $twig->render('seeds.html.twig', $data);
?>
