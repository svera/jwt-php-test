<?php

if ($_POST['email'] == 'me@example.com' && $_POST['password'] == '123') {
    $now = new Datetime();
    $payload = [
        'iss' => 'http://example.org',
        'aud' => 'http://example.com',
        'exp' => $now->add(new DateInterval('PT'.EXPIRATION_TIME_IN_MINUTES.'M'))->getTimestamp(),
        'name' => 'John Doe'
    ];

    $jwt = JWT::encode($payload, SECRET, 'HS256');
    setcookie('jwt', $jwt);
    header('Location: restricted');
    die();
}
