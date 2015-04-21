# JWT PHP Test
A proof of concept of a JSON web token (JWT) use case in PHP. The app is just a login controller which authorizes access to a 
restricted one, returning a signed JWT when login credentials are right. This token is used in subsequent requests to verify
permission.

To run it, just clone the repository, install dependencies with ```composer install``` and execute internal PHP web server using
```index.php``` as router: ```php -S localhost:8000 index.php```, then go to ```localhost:8000``` in your web browser. Use ```me@example.com``` as email address and ```123``` as password to log in.

Internally, it uses [Firebase PHP JWT library](https://github.com/firebase/php-jwt) to do the JWT encoding/decoding/verifying. Signature uses a [symmetric encryption](https://support.microsoft.com/en-us/kb/246071) schema. Of course, code is pretty awful consciouslly
in order to keep things as simple an understandable as possible.

## Requirements
* PHP >= 5.4
* Composer
