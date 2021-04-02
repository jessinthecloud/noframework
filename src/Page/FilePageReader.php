<?php declare(strict_types = 1);

namespace Example\Page;

use InvalidArgumentException;

class FilePageReader implements PageReader
{
    private $pageFolder;
    
    // folder as constructor arg makes the class flexible and if we decide to move files or write unit tests for the class, we can easily change the location with the constructor argument
    public function __construct(string $pageFolder)
    {
        $this->pageFolder = $pageFolder;
    }

    public function readBySlug(string $slug) : string
    {
        return 'I am a placeholder';
    }
}
