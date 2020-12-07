<?php
require_once 'base.php';

$entries = array(
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
    createEntry('8th Grade 2', 'crumbumb', 'event', array('School'), 'Unfortunately due to mitigating cirumstances, I cannot be bothered to present the facts.'),
    createEntry('1984 Pontiac Parisienne 2', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Acton-Boxboro Regional High School 2', 'crumbumb', 'place', array('School'), 'Twas the night before Christmas, when all through the house, not a creature was stirring.'),
    createEntry('Yokohama 2', 'crumbumb', 'place', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('1980 Honda Civic 2', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Bagger at Triple A 2', 'crumbumb', 'event', array('Job'), 'Whenever people call me on the telephone, I hang up and ride my bicycle to visit them in person.'),
    createEntry('Nathan Maxwell 2', 'crumbumb', 'person', array('Friend','Japan'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Penelope Griswald 2', 'crumbumb', 'person', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Technical Writer at BeyondMail 2', 'crumbumb', 'event', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Crumbumb 2', 'crumbumb', 'thing', array('Fnoot'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Bagger at Triple A 3', 'crumbumb', 'event', array('Job'), 'Whenever people call me on the telephone, I hang up and ride my bicycle to visit them in person.'),
    createEntry('Nathan Maxwell 3', 'crumbumb', 'person', array('Friend','Japan'), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Penelope Griswald 3', 'crumbumb', 'person', array(), 'Unfortunately due to mitigating cirumstances...'),
    createEntry('Technical Writer at BeyondMail 3', 'crumbumb', 'event', array(), 'Unfortunately due to mitigating cirumstances...'),
);

$entries[2]->start = new DateTime('2010-01-02');
$entries[2]->end = new DateTime('2012-04-02');

// get request params and set defaults
$type = $_REQUEST['type'];
$sort = $_REQUEST['sort'];
if ($sort == '') {
    $sort = 'modified';
}
if ($_REQUEST['tags'] == '') {
    $tags = array();
} else {
    $tags = explode(',', $_REQUEST['tags']);
}

$pager = new Pager(count($entries));
$pager->setRequestState();

// apply page

// set controller data
$data['h1'] = 'Browse';
$data['entries'] = $pager->slicePage($entries);
$params = array();
$params['type'] = $type;
$params['type'] = $type;
$params['tags'] = $tags;
$params['sort'] = $sort;
$params['page'] = $pager->page;
$params['pages'] = $pager->pages;
$data['params'] = $params;

echo $twig->render('browse.html.twig', $data);
?>
