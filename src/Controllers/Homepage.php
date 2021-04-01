<?php 
declare(strict_types = 1);
// autoloader will only work if the namespace of a class matches the file path and the file name equals the class name

// Example is the root namespace of the application so this is referring to the src/ folder
namespace Example\Controllers;

class Homepage
{
    public function show()
    {
        echo 'Hello World';
    }
}
