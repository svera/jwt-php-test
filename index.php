<?php

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));

const SECRET = 'abracadabra';

if (strtok($_SERVER['REQUEST_URI'], '?') == '/sign' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'sign.php';
} elseif (strtok($_SERVER['REQUEST_URI'], '?') == '/restricted' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    include_once 'restricted.php';
} elseif (strtok($_SERVER['REQUEST_URI'], '?') == '/') {
    include_once 'login.php';
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'Page not found';
}
