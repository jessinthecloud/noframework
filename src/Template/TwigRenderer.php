<?php declare(strict_types = 1);

namespace Example\Template;

use Twig\Environment;

class TwigRenderer implements Renderer
{
    private $renderer;

    public function __construct(Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    public function render($template, $data = []) : string
    {
        // .html extension is added because Twig does not add a file ending by default 
        // you would have to specifiy it on every call otherwise
        return $this->renderer->render("$template.html", $data);
    }
}
