<?php

require "vendor/autoload.php";
use Namshi\JOSE\JWS;

if (count($_POST) > 0) {
	if ($_POST['email'] == 'me@example.com' && $_POST['password'] == '123') {
		$key = "abracadabra";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => time(),
            "nbf" => time()
        );
        $jws = new JWS('RS256');
        $jws->setPayload($payload);
        $jws->sign($key);
        setcookie('jwt', $jws->getTokenString());
        header('Location: restricted.php');
        die();
	}
    header('Location: index.php');
}