<?php

require "vendor/autoload.php";
use Namshi\JOSE\JWS;

if ($_GET['action'] == 'logout') {
    setcookie ("jwt", "", time() - 3600);
    header('Location: index.php');
}

if (!$_COOKIE['jwt']) {
    header('Location: index.php');
}

$key = "abracadabra";

$jws = JWS::load($_COOKIE['jwt']);

if (!$jws->isValid($key, 'RS256')) {
    header('HTTP/1.0 403 Forbidden');
}

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache' => false
));

echo $twig->render('restricted.html', array('claims' => json_encode((array)$claims), 'token' => $_COOKIE['jwt']));
