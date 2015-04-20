<?php

if ($_POST['email'] == 'me@example.com' && $_POST['password'] == '123') {
    $payload = array(
        "iss" => "http://example.org",
        "aud" => "http://example.com",
        "iat" => time(),
        "nbf" => time()
    );

    $jwt = JWT::encode($payload, SECRET, 'HS256');
    setcookie('jwt', $jwt);
    header('Location: restricted');
    die();
}
