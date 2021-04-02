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

// tell the injector about our Renderer interface relationships
$injector->alias('Example\Template\Renderer', 'Example\Template\TwigRenderer');
// Instead of just defining the dependencies, we are using a delegate to give the responsibility to create the class to a function
$injector->delegate('\Twig\Environment', function () use ($injector) {
    $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
    $twig = new \Twig\Environment($loader);
    return $twig;
});

// tell the injector about our interface relationships
$injector->alias('Example\Page\PageReader', 'Example\Page\FilePageReader');
$injector->share('Example\Page\FilePageReader');
// tell injector how to populate the constructor
$injector->define('Example\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);

// tell injector about our front end interface
$injector->alias('Example\Template\FrontendRenderer', 'Example\Template\FrontendTwigRenderer');

$injector->alias('Example\Menu\MenuReader', 'Example\Menu\ArrayMenuReader');
$injector->share('Example\Menu\ArrayMenuReader');

return $injector;
