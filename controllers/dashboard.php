<?php
require_once 'base.php';

$data['h1'] = 'Dashboard';
echo $twig->render('dashboard.html.twig', $data);
?>