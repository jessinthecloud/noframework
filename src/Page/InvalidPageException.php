<?php declare(strict_types = 1);

namespace Example\Page;

use Exception;
// give ability to communicate that a page was not found
class InvalidPageException extends Exception
{
    public function __construct($slug, $code = 0, Exception $previous = null)
    {
        // !! TODO: should input be printed like this? Has the router sanitized it already?
        $message = "No page with the slug `$slug` was found";
        parent::__construct($message, $code, $previous);
    }
}
