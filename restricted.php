<?php

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    setcookie('jwt', '', time() - 3600);
    header('Location: /');
    die();
}

if (!$_COOKIE['jwt']) {
    header('Location: /?alert='.urlencode('You need to log in to access this page'));
    die();
}

try {
    $claims = JWT::decode($_COOKIE['jwt'], SECRET, ['HS256']);
} catch (ExpiredException $e) {
    header('Location: /?alert='.urlencode('Session expired'));
    die();
}

if (!$claims) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Forbidden';
    die();
}

$now = new Datetime();
$expires = $now->add(new DateInterval('PT'.EXPIRATION_TIME_IN_MINUTES.'M'));
// Refresh JWT expiration time
$payload = [
    'iss' => 'http://example.org',
    'aud' => 'http://example.com',
    'exp' => $expires->getTimestamp()
];

$jwt = JWT::encode($payload, SECRET, 'HS256');
setcookie('jwt', $jwt);

$dividedToken = explode('.', $jwt);
echo $twig->render(
    'restricted.html',
    [
        'claims' => json_encode($claims),
        'token_header' => $dividedToken[0],
        'token_payload' => $dividedToken[1],
        'token_signature' => $dividedToken[2],
        'expires' => $expires->format('H:i:s')
    ]   
);
