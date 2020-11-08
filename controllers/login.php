<?php
require_once 'base.php';

$data['h1'] = 'Login';
echo $twig->render('login.html.twig', $data);
?>