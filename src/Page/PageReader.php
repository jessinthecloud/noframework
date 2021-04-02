<?php declare(strict_types = 1);

namespace Example\Page;
/**
 * decouple the page reader from any specific implementations
 *
 * now we can use it with Page to read from files, or change to later read from a database 
 */
interface PageReader
{
    public function readBySlug(string $slug) : string;
}
