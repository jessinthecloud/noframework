<?php 
declare(strict_types = 1);

namespace Example\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Example\Template\Renderer;
use Example\Page\PageReader;
use Example\Page\InvalidPageException;

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
        // show 404 if page doesn't exist
        try{
            $data['content'] = $this->page_reader->readBySlug($slug);
        } catch (InvalidPageException $e) {
            $this->response->setStatusCode(404);
            return $this->response->setContent('404 - Page not found');

            // TODO: re-throw $e and allow errorhandler to take care of it for us?
            // TODO: setup reusable 404 content ?
        }
        
        $html = $this->renderer->render('Page', $data);
        $this->response->setContent($html);
    }
}
