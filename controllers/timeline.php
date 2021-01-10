<?php
require_once 'base.php';

function createDatedEntry($start, $end, $name, $slug, $type, $tags, $description) {
	$entry = new Entry();
	$entry->name = $name;
	$entry->slug = $slug;
	$entry->type->set($type);
	$entry->tags = $tags;
    $entry->description = $description;
    $entry->start = new DateTime($start);
    if ($end != '') {
        $entry->end = new DateTime($end);
    }
	return $entry;
}

$min = 1980;
$max = 2021;
$years = array("1980", '1981', '1982', '1983', '1984', '1985', '1990', '1992', '1995', '1998', '2000', '2005', '2007', '2014', '2021');

$entries = array(
    createDatedEntry('1988-09-01','1989-06-01','8th Grade', 'crumbumb', 'event', array('School'), 'Unfortunately due to mitigating cirumstances, I cannot be bothered to present the facts.'),
    // createDatedEntry('1984 Pontiac Parisienne', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Acton-Boxboro Regional High School', 'crumbumb', 'place', array('School'), 'Twas the night before Christmas, when all through the house, not a creature was stirring.'),
    // createDatedEntry('Yokohama', 'crumbumb', 'place', array(), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('1980 Honda Civic', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Bagger at Triple A', 'crumbumb', 'event', array('Job'), 'Whenever people call me on the telephone, I hang up and ride my bicycle to visit them in person.'),
    // createDatedEntry('Nathan Maxwell', 'crumbumb', 'person', array('Friend','Japan'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Penelope Griswald', 'crumbumb', 'person', array(), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Technical Writer at BeyondMail', 'crumbumb', 'event', array(), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Crumbumb', 'crumbumb', 'thing', array('Fnoot'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('8th Grade 2', 'crumbumb', 'event', array('School'), 'Unfortunately due to mitigating cirumstances, I cannot be bothered to present the facts.'),
    // createDatedEntry('1984 Pontiac Parisienne 2', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Acton-Boxboro Regional High School 2', 'crumbumb', 'place', array('School'), 'Twas the night before Christmas, when all through the house, not a creature was stirring.'),
    // createDatedEntry('Yokohama 2', 'crumbumb', 'place', array(), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('1980 Honda Civic 2', 'crumbumb', 'thing', array('Car'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Bagger at Triple A 2', 'crumbumb', 'event', array('Job'), 'Whenever people call me on the telephone, I hang up and ride my bicycle to visit them in person.'),
    // createDatedEntry('Nathan Maxwell 2', 'crumbumb', 'person', array('Friend','Japan'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Penelope Griswald 2', 'crumbumb', 'person', array(), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Technical Writer at BeyondMail 2', 'crumbumb', 'event', array(), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Crumbumb 2', 'crumbumb', 'thing', array('Fnoot'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Bagger at Triple A 3', 'crumbumb', 'event', array('Job'), 'Whenever people call me on the telephone, I hang up and ride my bicycle to visit them in person.'),
    // createDatedEntry('Nathan Maxwell 3', 'crumbumb', 'person', array('Friend','Japan'), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Penelope Griswald 3', 'crumbumb', 'person', array(), 'Unfortunately due to mitigating cirumstances...'),
    // createDatedEntry('Technical Writer at BeyondMail 3', 'crumbumb', 'event', array(), 'Unfortunately due to mitigating cirumstances...'),
);

// get request params and set defaults
$type = $_REQUEST['type'];
if ($_REQUEST['tags'] == '') {
    $tags = array();
} else {
    $tags = explode(',', $_REQUEST['tags']);
}
if ($_REQUEST['start'] == '') {
    $start = $min;
} else {
    $start = $_REQUEST['start'];
}
if ($_REQUEST['end'] == '') {
    $end = $max;
} else {
    $end = $_REQUEST['end'];
}

$pager = new Pager(count($entries));
$pager->setRequestState();

// apply page

// set controller data
$data['h1'] = 'Timeline';
$data['entries'] = $pager->slicePage($entries);
$data['min'] = $min;
$data['max'] = $max;
$data['years'] = $years;
$params = array();
$params['type'] = $type;
$params['tags'] = $tags;
$params['start'] = $start;
$params['end'] = $end;
$params['page'] = $pager->page;
$params['pages'] = $pager->pages;
$data['params'] = $params;

echo $twig->render('timeline.html.twig', $data);
?>
