<?php 
declare(strict_types = 1);

namespace Example\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Example\Template\Renderer;
use Example\Page\PageReader;

class Page
{
    protected $response;
    protected $renderer;
    protected $page_reader;

    public function __construct(
        Response $response, 
        Renderer $renderer, 
        PageReader $page_reader
    )
    {
        $this->response = $response;
        $this->renderer = $renderer;
        $this->page_reader = $page_reader;
    }

    
    // because the Router is using the URL (route info) to build the call to this class, it can pass the $params values to show()
    public function show($params)
    {
        $slug = $params['slug'];
        $data['content'] = $this->page_reader->readBySlug($slug);
        $html = $this->renderer->render('Page', $data);
        $this->response->setContent($html);
    }
}
