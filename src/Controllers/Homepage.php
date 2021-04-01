<?php 
declare(strict_types = 1);
// autoloader will only work if the namespace of a class matches the file path and the file name equals the class name

// Example is the root namespace of the application so this is referring to the src/ folder
namespace Example\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Homepage
{
    private $response;

    // inject the Response dependency
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function show()
    {
        $this->response->setContent('Hello World');
    }
}
