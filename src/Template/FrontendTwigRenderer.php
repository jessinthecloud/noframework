<?php declare(strict_types = 1);

namespace Example\Template;

use Example\Menu\MenuReader;

/**
 * a wrapper for our Renderer that adds the menuItems to all $data arrays
 */
class FrontendTwigRenderer implements FrontendRenderer
{
    private $renderer;
    protected $menu_reader;

    // we can pass any renderer that implements the Renderer interface
    public function __construct(Renderer $renderer, MenuReader $menu_reader)
    {
        $this->renderer = $renderer;
        $this->menu_reader = $menu_reader;
    }

    public function render($template, $data = []) : string
    {
        // auto-add menu items to every page that is rendered
        $data = array_merge($data, [
            'menuItems' => $this->menu_reader->readMenu(),
        ]);
        return $this->renderer->render($template, $data);
    }
}
