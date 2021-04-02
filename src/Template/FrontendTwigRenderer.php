<?php declare(strict_types = 1);

namespace Example\Template;

/**
 * a wrapper for our Renderer that adds the menuItems to all $data arrays
 */
class FrontendTwigRenderer implements FrontendRenderer
{
    private $renderer;

    // we can pass any renderer that implements the Renderer interface
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function render($template, $data = []) : string
    {
        // auto-add menu items to every page that is renderer
        $data = array_merge($data, [
            'menuItems' => [['href' => '/', 'text' => 'Homepage']],
        ]);
        return $this->renderer->render($template, $data);
    }
}
