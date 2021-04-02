<?php 
declare(strict_types = 1);
// autoloader will only work if the namespace of a class matches the file path and the file name equals the class name

// Example is the root namespace of the application so this is referring to the src/ folder
namespace Example\Controllers;

// import namespaces so we can call succintly with Response $reponse/Request $request
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Homepage
{
    private $response;

    // inversion of control with dependency injection --
        // instead of making the class responsible for creating the obj it needs,
        // just ask for it instead
    //  inject the Response dependency 
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function show()
    {
        $this->response->setContent('Hello World');
    }
}
