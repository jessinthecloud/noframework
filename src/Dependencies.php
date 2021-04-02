<?php 
declare(strict_types = 1);
// https://github.com/rdlowrey/Auryn#basic-instantiation
$injector = new \Auryn\Injector;

// sharing the HTTP objects because there would not be much point in adding content to one object and then returning another one. So by sharing it you always get the same instance
$injector->share('Symfony\Component\HttpFoundation\Request');
// tell the injector what to give to the constructor
// constructor args listed here: https://github.com/symfony/symfony/blob/5.2/src/Symfony/Component/HttpFoundation/Request.php
$injector->define('Symfony\Component\HttpFoundation\Request', [
    ':query' => $_GET,
    ':request' => $_POST,
    ':attributes' => [], // The request attributes (parameters parsed from the PATH_INFO, ...)
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
    ':content'=> '' // raw body data
]);
$injector->share('Symfony\Component\HttpFoundation\Response');

// don't need alias because the Symfony Http Response and Request we are using are concrete classes; not interfaces or obstract

/*$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');*/

return $injector;
