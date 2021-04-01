<?php
declare(strict_types = 1);

namespace Example;
// https://symfony.com/doc/current/components/http_foundation.html#installation
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// makes sure we use Composer
require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'development';

/**
* Register the error handler
*/
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

/*
Equivalent to 
$request = new Request(
    $_GET,
    $_POST,
    [],
    $_COOKIE,
    $_FILES,
    $_SERVER
);
 */
$request = Request::createFromGlobals();

/*
holds all the information that needs to be sent back to the client from a given request
 */
$response = new Response(
    'Hello World', // response content
    Response::HTTP_OK, // status code; Response::HTTP_NOT_FOUND, etc
    ['content-type' => 'text/html'] // HTTP headers
);

// When setting the Content-Type of the Response, you can set the charset, but it is better to set it via the setCharset() method:
// $response->setCharset('UTF-8');
// by default, Symfony assumes that your Responses are encoded in UTF-8

// optionally call the prepare() method to fix any incompatibility with the HTTP specification (e.g. a wrong Content-Type header)
$response->prepare($request);
// send response to client
$response->send();
