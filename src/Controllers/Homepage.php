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

    // inversion of control with dependency injection (SOLID pattern) --
        // instead of making the class responsible for creating the obj it needs,
        // just ask for it instead
    //  inject the Response dependency 
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function show()
    {
        $content = '<h1>Hello World</h1>';
        // get($arg1, $arg2=null) Returns a parameter by name
            // $arg1 : parameter name 
            // $arg2 : default value to return if the parameter does not exist
        $content .= 'Hello, ' . $this->request->query->get('name', 'stranger');
        $this->response->setContent($content);
    }
}
