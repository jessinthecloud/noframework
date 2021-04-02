<?php 
declare(strict_types = 1);

namespace Example\Template;

/*
We don't want to tightly couple a specific renderer to our Homepage controller 
    e.g., __construct(Request $request, Response $response, Twig Renderer){}
because then we will have to go change every reference if our renderer changes

We can use an interface as a wildcard renderer that can pass a specific one through
 */
interface Renderer
{
    public function render($template, $data = []) : string;
}
