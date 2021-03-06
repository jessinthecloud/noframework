<?php
declare(strict_types = 1);

namespace Example;
// https://symfony.com/doc/current/components/http_foundation.html
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
// ONLY show errors if we are on a testing server
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

// instead of making a new instance every time, we want to be passing the same one around
$injector = include('Dependencies.php');

$request = $injector->make('Symfony\Component\HttpFoundation\Request');

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

/*
holds all the information that needs to be sent back to the client from a given request
 */
$response = $injector->make('Symfony\Component\HttpFoundation\Response');

/*
register the available routes
 */
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

// dispatch the route if found (execute the function for that route)
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];
        // instantiating object specified by the route 
            // injecting Response to the contructor
            // use the injector so that we are using the szme Response/Request
        $class = $injector->make($className);
        // calling the method specified by the route
        $class->$method($vars);
        break;
}

/*
Can also change after creation

$response->setContent('Hello World');

// the headers public attribute is a ResponseHeaderBag
$response->headers->set('Content-Type', 'text/plain');

$response->setStatusCode(Response::HTTP_NOT_FOUND);
 */

// When setting the Content-Type of the Response, you can set the charset, but it is better to set it via the setCharset() method:
// $response->setCharset('UTF-8');
// by default, Symfony assumes that your Responses are encoded in UTF-8

// optionally call the prepare() method to fix any incompatibility with the HTTP specification (e.g. a wrong Content-Type header)
$response->prepare($request);
// send response to client
$response->send();
