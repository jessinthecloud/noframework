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

    // TODO: probable shouldn't do this... check against whitelist?
    public function readBySlug(string $slug) : string
    {
        $path = "$this->pageFolder/$slug.md";

        if (!file_exists($path)) {
            throw new InvalidPageException($slug);
        }

        return file_get_contents($path);
    }
}
