<?php
require_once 'base.php';

$data['h1'] = 'Sign Up';
echo $twig->render('signup.html.twig', $data);
?>