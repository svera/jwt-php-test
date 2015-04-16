<?php

require "vendor/autoload.php";

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));

echo $twig->render('index.html', array('name' => 'Fabien'));
