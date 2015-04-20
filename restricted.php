<?php

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    setcookie('jwt', '', time() - 3600);
    header('Location: /');
}

if (!$_COOKIE['jwt']) {
    header('Location: /?alert='.urlencode('You need to log in to access this page'));
}

$claims = JWT::decode($_COOKIE['jwt'], SECRET, array('HS256'));
if (!$claims) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Forbidden';
}

echo $twig->render(
    'restricted.html',
    array('claims' => json_encode($claims), 'token' => $_COOKIE['jwt'])
);
